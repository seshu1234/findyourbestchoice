@props(['tool'])

@php
    $images = is_array($tool->images) ? $tool->images : (json_decode($tool->images ?? '[]', true) ?: []);
    $thumbnail = $tool->logo_url ?: ($images[0] ?? null);
@endphp

<div class="border rounded-xl p-4 hover:shadow transition">
    <a href="{{ route('tools.show', ['slug' => $tool->slug]) }}" class="block">
        <div class="flex items-start gap-3">
            @if($thumbnail)
                <img src="{{ $thumbnail }}" class="w-12 h-12 rounded object-cover flex-shrink-0" alt="{{ $tool->name }}">
            @else
                <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-gray-500">AI</div>
            @endif

            <div class="flex-1 min-w-0">
                <h3 class="font-semibold text-lg truncate">{{ $tool->name }}</h3>
                <p class="text-sm text-gray-600 line-clamp-2">{{ $tool->short_description }}</p>
                <div class="mt-2 flex items-center gap-2 text-xs text-gray-500">
                    <span>{{ $tool->upvotes ?? 0 }} upvotes</span>
                    @if($tool->price_from)
                        <span>• from {{ $tool->price_from }}</span>
                    @endif
                </div>
            </div>
        </div>
    </a>
</div>
