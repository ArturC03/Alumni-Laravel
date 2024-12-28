<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Alumni') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Open+Sans:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Bladewind -->
        <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">

        @livewire('navigation-menu')
        <x-banner />

        <div class="min-h-screen bg-secondary-color-50 dark:bg-secondary-color-900">

            @if (isset($header))
                    <header class="bg-white dark:bg-secondary-color-800 dark:text-secondary-color-50 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @livewireScripts
        <!-- Bladewind JS -->
        <script src="{{ asset('vendor/bladewind/js/helpers.js') }}" type="text/javascript"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Check if user prefers dark mode
                const prefersDarkMode = window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches;

                // Send preference to the server using an AJAX request (or store it in localStorage)
                if (prefersDarkMode) {
                    // Set dark mode in session (via a GET request, for example)
                    fetch('/set-theme/dark');
                } else {
                    fetch('/set-theme/light');
                }
            });
        </script>

    </body>
</html>
