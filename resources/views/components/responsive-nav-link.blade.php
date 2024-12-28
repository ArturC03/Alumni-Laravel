@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-primary-color-400 dark:border-primary-color-600 text-start text-base font-medium text-primary-color-700 dark:text-primary-color-300 bg-primary-color-50 dark:bg-primary-color-900/50 focus:outline-none focus:text-primary-color-800 dark:focus:text-primary-color-200 focus:bg-primary-color-100 dark:focus:bg-primary-color-900 focus:border-primary-color-700 dark:focus:border-primary-color-300 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-secondary-color-600 dark:text-secondary-color-400 hover:text-secondary-color-800 dark:hover:text-secondary-color-200 hover:bg-secondary-color-50 dark:hover:bg-secondary-color-700 hover:border-secondary-color-300 dark:hover:border-secondary-color-600 focus:outline-none focus:text-secondary-color-800 dark:focus:text-secondary-color-200 focus:bg-secondary-color-50 dark:focus:bg-secondary-color-700 focus:border-secondary-color-300 dark:focus:border-secondary-color-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
