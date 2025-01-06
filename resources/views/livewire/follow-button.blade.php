<div class="flex items-center justify-center h-full">
    <button
        @auth
            wire:click="toggleFollow"
        @else
            wire:click="redirectToLogin"
        @endauth
        class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-200 focus:outline-none focus:ring-2
            {{ $isFollowing
                ? 'bg-gray-200 text-gray-800 hover:bg-gray-300 focus:ring-gray-400'
               : 'bg-primary text-white hover:bg-primary-600 focus:ring-primary/50' }}">
        {{ $isFollowing ? 'A Seguir' : 'Seguir' }}
    </button>
</div>
