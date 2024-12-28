<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => '
            inline-flex
            items-center
            justify-center
            px-4
            py-2
            rounded-md
            font-semibold
            text-sm
            transition-all
            duration-150
            ease-in-out
            bg-primary-color
            text-white
            hover:bg-primary-color-500
            focus:outline-none
            focus:ring-2
            focus:ring-primary-color/50
            focus:ring-offset-2
            dark:bg-secondary-color-50
            dark:text-secondary-color-800
            dark:hover:bg-secondary-color-100
            dark:focus:ring-primary-color
            dark:focus:ring-offset-secondary-color-400
            disabled:opacity-50
            disabled:cursor-not-allowed
        '
    ]) }}>
    {{ $slot }}
</button>
