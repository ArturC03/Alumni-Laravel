    <div class="px-6 py-4 flex items-center border-none border-primary-100 dark:border-secondary-400">
        <a href="{{ route('perfil.show',  $author->id) }}">
            <img
                src="{{ $author->profile_photo_url }}"
                alt="{{ $author->name }}"
                class="w-12 h-12 rounded-full object-cover ring-2 ring-primary-100 dark:ring-secondary-400">
        </a>
        <div class="ml-4 flex-1">
            <a href="{{ route('perfil.show',  $author->id) }}">
                <h2 class="w-fit text-base font-semibold text-secondary-500 dark:text-primary-100 hover:text-primary-500 dark:hover:text-primary-400 transition-colors">
                    {{ $author->name }}
                </h2>
            </a>
            <a href="{{ route('profile.show', $author->id) }}">
                <span class="text-sm text-secondary-300 dark:text-secondary-200">
                    {{'@' . $author->nickname }}
                </span>
            </a>
        </div>
    </div>
