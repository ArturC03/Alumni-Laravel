@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary-600 dark:border-primary-500 text-sm font-medium leading-5 text-secondary-800 dark:text-secondary-100 focus:outline-none focus:border-primary-700 dark:focus:border-primary-600 transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-secondary-600 dark:text-secondary-300 hover:text-primary-700 dark:hover:text-primary-500 hover:border-primary-600 dark:hover:border-primary-500 focus:outline-none focus:text-primary-700 dark:focus:text-secondary-200 focus:border-primary-700 dark:focus:border-primary-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
