@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary-color-600 dark:border-primary-color-500 text-sm font-medium leading-5 text-secondary-color-800 dark:text-secondary-color-100 focus:outline-none focus:border-primary-color-700 dark:focus:border-primary-color-600 transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-secondary-color-600 dark:text-secondary-color-300 hover:text-primary-color-700 dark:hover:text-primary-color-500 hover:border-primary-color-600 dark:hover:border-primary-color-500 focus:outline-none focus:text-primary-color-700 dark:focus:text-secondary-color-200 focus:border-primary-color-700 dark:focus:border-primary-color-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
