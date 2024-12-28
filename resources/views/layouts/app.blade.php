<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Alumni') }}</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Open+Sans:wght@400;500;700&display=swap" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="mx-auto md:w-[85%] lg:w-[90%] bg-gray-100 dark:bg-secondary-color-900 font-sans antialiased">
    <x-banner />
    <div class="min-h-screen">
        <div class="mx-auto">
            <div class="grid grid-cols-12">
                <!-- Sidebar -->
                <aside class="col-span-2 hidden md:block">
                    <div class="sticky top-0 pt-4">
                        @livewire('navigation-menu')
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="col-span-12 md:col-span-10">
                    @if (isset($header))
                    <header class="bg-white dark:bg-secondary-color-800 shadow mb-4">
                        <div class="py-8 px-4">
                            {{ $header }}
                        </div>
                    </header>
                    @endif
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    @stack('modals')
    @livewireScripts
</body>

</html>
