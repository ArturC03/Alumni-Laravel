<div>
    <button
        @auth
            wire:click="toggleFollow"
        @else
            wire:click="redirectToLogin"
        @endauth
        class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-200 focus:outline-none focus:ring-2
            {{ $isFollowing
                ? 'bg-gray-200 text-gray-800 hover:bg-gray-300 focus:ring-gray-400'
                : 'bg-primary-color text-white hover:bg-primary-color-600 focus:ring-primary-color/50' }}">
        {{ $isFollowing ? 'A Seguir' : 'Seguir' }}
    </button>
</div>
