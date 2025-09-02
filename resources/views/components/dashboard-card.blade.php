@props(['title', 'value', 'color' => 'bg-gray-500', 'icon' => ''])

<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-4 flex items-center">
        <div class="w-10 h-10 {{ $color }} rounded-lg flex items-center justify-center mr-3">
            @if($icon && view()->exists('components.icons.' . $icon))
                <x-dynamic-component :component="'icons.' . $icon" class="w-5 h-5 text-white" />
            @else
                <!-- Fallback icon atau placeholder -->
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2L13 8h6l-5 4 2 6-6-4-6 4 2-6-5-4h6z"/>
                </svg>
            @endif
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900">{{ $value }}</p>
            <p class="text-sm text-gray-500">{{ $title }}</p>
        </div>
    </div>
</div>