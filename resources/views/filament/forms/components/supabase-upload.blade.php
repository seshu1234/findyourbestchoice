@php
    $supabaseUrl = env('SUPABASE_URL', '');
    $supabaseAnonKey = env('SUPABASE_ANON_KEY', '');
    $bucket = $getBucket();
    $initial = $getState() ?? ($getDefaultState() ?? null);
    $isMultiple = $get('multiple') ?? true;
@endphp

<div
    x-data="supabaseUploader({
        supabaseUrl: '{{ $supabaseUrl }}',
        supabaseKey: '{{ $supabaseAnonKey }}',
        bucket: '{{ $bucket }}',
        value: @json($initial),
        multiple: {{ $isMultiple ? 'true' : 'false' }},
        statePath: @js($getStatePath()),
    })"
    x-init="init()"
    class="space-y-3"
>
    {{-- Drag & drop zone --}}
    <div
        @dragover.prevent="dragOver = true"
        @dragleave.prevent="dragOver = false"
        @drop.prevent="handleDrop($event)"
        :class="{'border-dashed border-2 border-gray-300 bg-gray-50': !dragOver, 'border-solid border-2 border-blue-400 bg-blue-50': dragOver}"
        class="p-4 rounded"
    >
        <div class="flex items-center gap-3">
            <input type="file" x-ref="fileInput" @change="handleFiles($event)" :multiple="multiple" class="hidden" />
            <button type="button" class="fi-btn" @click="$refs.fileInput.click()">Choose file(s)</button>
            <div class="flex-1 text-sm text-gray-600">Drag & drop images here or click to select. Supported: png,jpg,jpeg,gif,webp</div>
        </div>

        {{-- progress list --}}
        <template x-for="(p, idx) in progress" :key="idx">
            <div class="mt-2">
                <div class="text-xs" x-text="p.name"></div>
                <div class="w-full bg-gray-200 rounded h-2 mt-1">
                    <div class="h-2 rounded" :style="'width: '+Math.floor(p.percent||0)+'%'"></div>
                </div>
            </div>
        </template>

        {{-- upload-by-URL --}}
        <div class="mt-3 flex gap-2">
            <input type="text" x-model="url" placeholder="Paste image URL and click Add" class="w-full border rounded p-2 text-sm" />
            <button type="button" class="fi-btn" @click="uploadUrl()">Add</button>
        </div>
    </div>

    {{-- gallery preview --}}
    <div class="grid grid-cols-4 gap-3">
        <template x-for="(img, i) in gallery" :key="i">
            <div class="relative border rounded overflow-hidden">
                <img :src="img" class="object-cover w-full h-24" />
                <button type="button" class="absolute top-1 right-1 bg-white/80 rounded px-2 py-1 text-xs" @click="deleteImage(i)">Delete</button>
                <button type="button" class="absolute bottom-1 left-1 bg-white/80 rounded px-2 py-1 text-xs" @click="copyUrl(img)">Copy URL</button>
            </div>
        </template>
    </div>

    {{-- Hidden input bound to Livewire/Filament form state --}}
    <input type="hidden" x-ref="state" x-model="internalState" />

    {{-- small helper --}}
    <div class="text-xs text-gray-500">Files are uploaded directly to Supabase Storage. The field stores an array of public URLs.</div>

    {{-- Supabase JS (CDN) + Alpine helper --}}
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2/dist/umd/supabase.min.js"></script>
    <script>
        function supabaseUploader(config) {
            return {
                supabaseUrl: config.supabaseUrl || '',
                supabaseKey: config.supabaseKey || '',
                bucket: config.bucket || 'public',
                url: '',
                dragOver: false,
                gallery: Array.isArray(config.value) ? config.value.slice() : (config.value ? [config.value] : []),
                progress: [],
                internalState: config.value ? (Array.isArray(config.value) ? JSON.stringify(config.value) : JSON.stringify([config.value])) : '[]',
                multiple: !!config.multiple,
                statePath: config.statePath,
                supabase: null,

                init() {
                    try {
                        this.supabase = supabase.createClient(this.supabaseUrl, this.supabaseKey);
                    } catch(e) {
                        // supabase client not loaded
                        console.error('Supabase client not available', e);
                    }
                    // set Livewire state initially
                    this.syncState();
                },

                // fallback: accept DataTransfer or input files
                handleFiles(e) {
                    const files = e.target ? e.target.files : (e.dataTransfer ? e.dataTransfer.files : []);
                    for (let i = 0; i < files.length; i++) {
                        this.uploadFileToSupabase(files[i]);
                    }
                },

                handleDrop(ev) {
                    this.dragOver = false;
                    const dt = ev.dataTransfer;
                    if (dt && dt.files && dt.files.length) {
                        this.handleFiles({ target: { files: dt.files } });
                    }
                },

                async uploadFileToSupabase(file) {
                    if (!this.supabase) return alert('Supabase client not initialized. Add SUPABASE_URL and SUPABASE_ANON_KEY to .env');
                    const filename = Date.now() + '-' + file.name.replace(/\s+/g,'-');
                    const path = filename;
                    // push progress item
                    const pIndex = this.progress.push({ name: file.name, percent: 0 }) - 1;
                    try {
                        // Supabase JS v2 doesn't provide per-file progress in browser easily using public client,
                        // so we do a simple upload and update to 100% when done.
                        const { error: upError } = await this.supabase
                            .storage
                            .from(this.bucket)
                            .upload(path, file, { cacheControl: '3600', upsert: false });

                        if (upError) throw upError;

                        // get public url
                        const { data } = this.supabase.storage.from(this.bucket).getPublicUrl(path);
                        const publicUrl = data?.publicUrl ?? null;
                        if (!publicUrl) throw new Error('No public url returned');

                        // push into gallery
                        if (!this.multiple) this.gallery = [publicUrl];
                        else this.gallery.push(publicUrl);

                        this.progress[pIndex].percent = 100;
                        this.syncState();
                    } catch (err) {
                        console.error('Upload error', err);
                        this.progress[pIndex].percent = 0;
                        alert('Upload failed: ' + (err?.message ?? err));
                    } finally {
                        // remove old finished progress after small delay
                        setTimeout(() => {
                            this.progress = this.progress.filter((x,i) => i !== pIndex);
                        }, 600);
                    }
                },

                async uploadUrl() {
                    try {
                        if (!this.url) return;
                        // If URL already points to your supabase domain and bucket, just add it; otherwise, fetch then upload
                        const isSupabaseUrl = this.url.includes(this.supabaseUrl) || this.url.startsWith('http');
                        if (isSupabaseUrl && this.url.includes('/storage/v1/object/public/')) {
                            // assume public url -> just add it
                            if (!this.multiple) this.gallery = [this.url];
                            else this.gallery.push(this.url);
                            this.url = '';
                            this.syncState();
                            return;
                        }

                        // fetch the remote file and re-upload to supabase
                        const resp = await fetch(this.url);
                        if (!resp.ok) throw new Error('Could not fetch URL');
                        const blob = await resp.blob();
                        const fileName = (new URL(this.url)).pathname.split('/').pop() || ('file-' + Date.now());
                        const file = new File([blob], fileName);
                        await this.uploadFileToSupabase(file);
                        this.url = '';
                    } catch (err) {
                        console.error(err);
                        alert('Failed to add from URL: ' + (err?.message ?? err));
                    }
                },

                copyUrl(url) {
                    navigator.clipboard?.writeText(url).then(() => {
                        // optionally give feedback
                    });
                },

                async deleteImage(index) {
                    const url = this.gallery[index];
                    // try to delete from storage if it matches supabase public path
                    try {
                        if (url.includes('/storage/v1/object/public/')) {
                            // derive path after '/storage/v1/object/public/{bucket}/'
                            const parts = url.split('/storage/v1/object/public/');
                            if (parts.length === 2) {
                                const after = parts[1];
                                // if bucket is included in that part, remove bucket prefix
                                const expectedPrefix = this.bucket + '/';
                                let path = after;
                                if (after.startsWith(expectedPrefix)) path = after.slice(expectedPrefix.length);
                                // call remove
                                const { error: delError } = await this.supabase.storage.from(this.bucket).remove([path]);
                                if (delError) {
                                    console.warn('Supabase remove error (non-fatal):', delError);
                                }
                            }
                        }
                    } catch (e) {
                        console.warn('Delete error (continuing):', e);
                    } finally {
                        this.gallery.splice(index, 1);
                        this.syncState();
                    }
                },

                // keep internalState in sync with gallery
                syncState() {
                    this.internalState = JSON.stringify(this.gallery);
                    // Update Livewire/Filament state
                    // Filament will bind input value automatically via the hidden input
                },

            };
        }
    </script>
</div>
