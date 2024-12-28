@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-secondary-color-300 dark:border-secondary-color-50 dark:bg-secondary-color text-secondary-color-800 dark:text-secondary-color-50 focus:border-primary-color-500 dark:focus:border-primary-color-500 focus:ring-primary-color-500 dark:focus:ring-primary-color-500 rounded-md shadow-sm']) !!}>
