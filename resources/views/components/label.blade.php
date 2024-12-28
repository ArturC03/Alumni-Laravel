@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-secondary-color-700 dark:text-secondary-color-300']) }}>
    {{ $value ?? $slot }}
</label>
