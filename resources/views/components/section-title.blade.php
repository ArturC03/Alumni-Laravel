<div class="md:col-span-1 flex justify-between">
    <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium text-secondary-color-900 dark:text-secondary-color-100">{{ $title }}</h3>

        <p class="mt-1 text-sm text-secondary-color-600 dark:text-secondary-color-400">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
