<div>
<section class="max-w-5xl mx-auto text-center py-20 px-4">
    <h1 class="text-4xl font-bold mb-3">Discover the Best AI Tools</h1>
    <p class="text-gray-600 mb-6">Browse tools for productivity, content, development, design and more.</p>

    <input wire:model.debounce.300ms="search"
           type="search"
           placeholder="Search AI tools..."
           class="w-full max-w-xl mx-auto border rounded-lg px-4 py-3" />
</section>

<section class="max-w-6xl mx-auto px-4 py-10">
    <h2 class="text-xl font-semibold mb-4">Featured Tools</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($featuredTools as $tool)
            <div class="border rounded-lg p-4 shadow-sm hover:shadow-lg transition">
                <img src="{{ $tool->logo_url }}" class="h-12 mb-3" alt="">
                <h3 class="font-semibold">{{ $tool->name }}</h3>
                <p class="text-gray-600 text-sm line-clamp-2">{{ $tool->short_description }}</p>
            </div>
        @endforeach
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 py-10">
    <h2 class="text-xl font-semibold mb-4">Recently Added</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($recentTools as $tool)
            <div class="border rounded-lg p-4 shadow-sm hover:shadow-lg transition">
                <img src="{{ $tool->logo_url }}" class="h-12 mb-3" alt="">
                <h3 class="font-semibold">{{ $tool->name }}</h3>
                <p class="text-gray-600 text-sm line-clamp-2">{{ $tool->short_description }}</p>
            </div>
        @endforeach
    </div>
</section>
</div>