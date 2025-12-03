<x-layouts.marketing>
    <section class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <h1 class="text-3xl font-bold">All AI Tools</h1>

            <div class="flex gap-3 items-center">
                <input wire:model.debounce.300ms="search" type="text" placeholder="Search tools..."
                       class="border px-3 py-2 rounded" />

                <select wire:model="sort" class="border px-3 py-2 rounded">
                    <option value="newest">Newest</option>
                    <option value="popular">Most Popular</option>
                </select>

                <select wire:model="category" class="border px-3 py-2 rounded">
                    <option value="">All categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($tools as $tool)
                @include('components.tool.card', ['tool' => $tool])
            @endforeach
        </div>

        <div class="mt-8">
            {{ $tools->links() }}
        </div>
    </section>
</x-layouts.marketing>
