<x-layouts.marketing>
    <section class="max-w-4xl mx-auto px-4 py-12">
        <div class="flex items-start gap-4">
            @if($tool->logo_url)
                <img src="{{ $tool->logo_url }}" class="w-20 h-20 rounded-lg border object-cover" alt="{{ $tool->name }}">
            @endif
            <div class="flex-1">
                <h1 class="text-3xl font-bold">{{ $tool->name }}</h1>
                <p class="text-gray-600 mt-1">{{ $tool->short_description }}</p>
                <div class="mt-4 flex gap-2">
                    @if($tool->official_url)
                        <a href="{{ $tool->official_url }}" target="_blank" class="px-4 py-2 rounded bg-blue-600 text-white">Visit</a>
                    @endif
                    @if($tool->affiliate_url)
                        <a href="{{ $tool->affiliate_url }}" target="_blank" class="px-4 py-2 rounded bg-green-600 text-white">Buy Deal</a>
                    @endif
                </div>
            </div>
        </div>

        @php
            $images = is_array($tool->images) ? $tool->images : (json_decode($tool->images ?? '[]', true) ?: []);
        @endphp

        @if(count($images))
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-6">
                @foreach($images as $img)
                    <img src="{{ $img }}" class="rounded-lg border object-cover w-full h-36" alt="">
                @endforeach
            </div>
        @endif

        <article class="prose max-w-none mt-8">
            {!! $tool->description !!}
        </article>

        <div class="grid md:grid-cols-2 gap-6 mt-8">
            @php
                $pros = is_array($tool->pros) ? $tool->pros : (json_decode($tool->pros ?? '[]', true) ?: []);
                $cons = is_array($tool->cons) ? $tool->cons : (json_decode($tool->cons ?? '[]', true) ?: []);
            @endphp

            @if(count($pros))
            <div>
                <h3 class="text-lg font-semibold mb-2">Pros</h3>
                <ul class="list-disc ml-5">
                    @foreach($pros as $p)
                        <li>{{ $p }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(count($cons))
            <div>
                <h3 class="text-lg font-semibold mb-2">Cons</h3>
                <ul class="list-disc ml-5">
                    @foreach($cons as $c)
                        <li>{{ $c }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </section>
</x-layouts.marketing>
