<!-- resources/views/components/textarea.blade.php -->
@props(['disabled' => false, 'id' => null, 'name' => null, 'value' => null, 'rows' => 4, 'required' => false])

    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => 'border-secondary-300 dark:border-secondary-700 dark:bg-secondary-900 text-secondary-800 dark:text-secondary-50 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-md shadow-sm mt-1 block w-full']) !!}
        required="{{ $required }}"
    >{{ old($name, $value) }}</textarea>
