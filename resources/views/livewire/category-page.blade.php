<x-layouts.marketing>
    <section class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">{{ $category->name }}</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($tools as $tool)
                @include('components.tool.card', ['tool' => $tool])
            @endforeach
        </div>

        <div class="mt-6">
            {{ $tools->links() }}
        </div>
    </section>
</x-layouts.marketing>
