<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 dark:bg-gradient-to-tl dark:from-secondary-color-550 dark:to-secondary-color-400">

<!-- Caixa central -->
    <div class="w-full sm:max-w-md px-6 py-6 bg-white dark:bg-secondary-color shadow-md rounded-md">
        <!-- Logo -->
        <div class="flex justify-center items-center mb-4">
            {{ $logo }}
        </div>

        <!-- Conteúdo -->
        <div class="text-gray-700 dark:text-secondary-color-50 ">
            {{ $slot }}
        </div>
    </div>
</div>
