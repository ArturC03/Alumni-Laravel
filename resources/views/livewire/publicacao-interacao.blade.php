<div>
    <button wire:click="this->handleAction()" class="flex items-center group space-x-2">
        @if ($active)
            <x-bladewind::icon
                name="{{ $icon }}"
                class="!h-5 !w-5 !fill-{{ $color }}-500 !stroke-{{ $color }}-500 transition-colors" />
            <span class="{{ $color }}-500 font-medium">
        @else
            <x-bladewind::icon
                name="{{ $icon }}"
                class="!h-5 !w-5 !fill-none group-hover:!stroke-{{ $color }}-500 !stroke-secondary-300 dark:!stroke-secondary-200 transition-colors" />
            <span class="text-secondary-300 dark:text-secondary-200 group-hover:text-{{ $color }}-500 font-medium transition-colors">
        @endif
            {{ $displayText }}
        </span>
    </button>
</div>
