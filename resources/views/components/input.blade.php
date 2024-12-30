@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-secondary-300 dark:border-secondary-50 dark:bg-secondary text-secondary-800 dark:text-secondary-50 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-primary-500 dark:focus:ring-primary-500 rounded-md shadow-sm']) !!}>
