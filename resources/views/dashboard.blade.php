<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary-color-800 dark:text-secondary-color-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-secondary-color-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome/>
            </div>
        </div>
    </div>
</x-app-layout>
