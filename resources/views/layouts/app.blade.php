
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Alumni') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Open+Sans:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Bladewind -->
        <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="bg-gray-50 dark:bg-secondary-900 text-secondary-900 dark:text-secondary-50 font-sans antialiased bg-center bg-repeat" style="background-image: url({{ asset('/images/dots.svg') }})">


<x-scroll-to-top-button class="flex justify-center items-center h-12 w-12 bg-primary-500 text-white rounded-full">
    <x-bladewind::icon name="arrow-up" />
</x-scroll-to-top-button>

        <!-- Navegação -->
        @livewire('navigation-menu')
        <x-banner />

        <div class="min-h-screen">

            @if (isset($header))
                <header class="dark:text-secondary-50 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Conteúdo principal -->
            <main class="mx-auto md:w-[85%] lg:w-[90%]">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <!-- Bladewind JS -->
        <script src="{{ asset('vendor/bladewind/js/helpers.js') }}" type="text/javascript"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Check if user prefers dark mode
                const prefersDarkMode = window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches;

                // Send preference to the server using an AJAX request (or store it in localStorage)
                if (prefersDarkMode) {
                    fetch('/set-theme/dark');
                } else {
                    fetch('/set-theme/light');
                }
            });
        </script>

    </body>
</html>

