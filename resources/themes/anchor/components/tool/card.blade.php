<div class="border rounded-xl p-4 hover:shadow transition">
    <a href="/tools/{{ $tool->slug }}">
        <div class="flex items-center gap-3">
            @if($tool->logo_url)
                <img src="{{ $tool->logo_url }}" class="w-12 h-12 rounded" />
            @endif

            <div>
                <h3 class="font-semibold text-lg">{{ $tool->name }}</h3>
                <p class="text-sm text-gray-600 line-clamp-2">
                    {{ $tool->short_description }}
                </p>
            </div>
        </div>
    </a>
</div>
