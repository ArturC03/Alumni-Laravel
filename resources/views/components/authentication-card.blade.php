<div class="min-h-screen flex flex-col justify-center items-center ">

<!-- Caixa central -->
    <div class="w-full sm:max-w-md px-6 py-6 bg-white dark:bg-secondary shadow-md rounded-md">
        <!-- Logo -->
        <div class="flex justify-center items-center mb-4">
            {{ $logo }}
        </div>

        <!-- Conteúdo -->
        <div class="text-gray-700 dark:text-secondary-50 ">
            {{ $slot }}
        </div>
    </div>
</div>
