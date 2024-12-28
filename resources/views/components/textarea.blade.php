<!-- resources/views/components/textarea.blade.php -->
@props(['disabled' => false, 'id' => null, 'name' => null, 'value' => null, 'rows' => 4, 'required' => false])

    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => 'border-secondary-color-300 dark:border-secondary-color-700 dark:bg-secondary-color-900 text-secondary-color-800 dark:text-secondary-color-50 focus:border-primary-color-500 dark:focus:border-primary-color-600 focus:ring-primary-color-500 dark:focus:ring-primary-color-600 rounded-md shadow-sm mt-1 block w-full']) !!}
        required="{{ $required }}"
    >{{ old($name, $value) }}</textarea>
