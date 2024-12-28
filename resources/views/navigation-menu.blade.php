<nav x-data="{ mobileMenuOpen: false }"
    class="h-[95dvh] sticky dark:bg-secondary-color-900 border-r border-gray-200 dark:border-secondary-color-800 flex flex-col items-center">

    <!-- Logo -->
    <div class="mb-6">
        <a href="{{ route('welcome') }}" class="flex items-center justify-center mx-4">
            <x-application-logo class="block h-10 w-auto" />
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 w-full space-y-4 flex flex-col items-center">
        @if (Auth::check())
        <!-- Welcome -->
        <a href="{{ route('welcome') }}"
            class="w-full flex items-center justify-center p-3 rounded-lg hover:bg-secondary-color-100 dark:hover:bg-secondary-color-800
                      {{ request()->routeIs('welcome') ? 'bg-secondary-color-100 dark:bg-secondary-color-800 text-primary-color' : 'text-secondary-color-500 dark:text-secondary-color-400' }}">
            <x-bladewind::icon name="home" size="6"></x-bladewind::icon>
        </a>

        <!-- Profile -->
        <a href="{{ route('profile.show') }}"
            class="w-full flex items-center justify-center p-3 rounded-lg hover:bg-secondary-color-100 dark:hover:bg-secondary-color-800
                      {{ request()->routeIs('profile.show') ? 'bg-secondary-color-100 dark:bg-secondary-color-800 text-primary-color' : 'text-secondary-color-500 dark:text-secondary-color-400' }}">
            <x-bladewind::icon name="user" size="6"></x-bladewind::icon>
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" x-data class="w-full flex items-center justify-center">
            @csrf
            <button @click.prevent="$root.submit();"
                class="w-full flex items-center justify-center p-3 rounded-lg hover:bg-secondary-color-100 dark:hover:bg-secondary-color-800 text-secondary-color-500 dark:text-secondary-color-400">
                <x-bladewind::icon name="power" size="6"></x-bladewind::icon>
            </button>
        </form>
        @else
        <!-- Login -->
        <a href="{{ route('login') }}"
            class="w-full flex items-center justify-center p-3 rounded-lg hover:bg-secondary-color-100 dark:hover:bg-secondary-color-800 text-secondary-color-500 dark:text-secondary-color-400">
            <x-bladewind::icon name="login" size="6"></x-bladewind::icon>
        </a>

        <!-- Register -->
        <a href="{{ route('register') }}"
            class="w-full flex items-center justify-center p-3 rounded-lg hover:bg-secondary-color-100 dark:hover:bg-secondary-color-800 text-secondary-color-500 dark:text-secondary-color-400">
            <x-bladewind::icon name="user-plus" size="6"></x-bladewind::icon>
        </a>
        @endif
    </div>

    @if (Auth::check())
    <!-- User Profile Section -->
    <div class="w-full">
        <a href="{{ route('profile.show') }}" class="flex items-center justify-center">
            <img class="h-10 w-10 rounded-full object-cover ring-2 ring-primary-color"
                src="{{ Auth::user()->profile_photo_url }}"
                alt="{{ Auth::user()->name }}">
        </a>
    </div>
    @endif
</nav>
