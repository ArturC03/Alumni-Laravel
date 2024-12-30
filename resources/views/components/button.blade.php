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
            bg-primary
            text-white
            hover:bg-primary-500
            focus:outline-none
            focus:ring-2
            focus:ring-primary/50
            focus:ring-offset-2
            dark:bg-secondary-50
            dark:text-secondary-800
            dark:hover:bg-secondary-100
            dark:focus:ring-primary
            dark:focus:ring-offset-secondary-400
            disabled:opacity-50
            disabled:cursor-not-allowed
        '
    ]) }}>
    {{ $slot }}
</button>
