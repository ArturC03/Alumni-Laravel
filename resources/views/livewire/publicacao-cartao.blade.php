<div
    class=" w-[100%] bg-primary-color-50 dark:bg-secondary-color-900 border-2 border-t-0 border-gray-200 dark:border-secondary-color-800 shadow-md w-96 max-w-full">
    <!-- Cabeçalho da Publicação -->
    <div
        class="px-6 py-5 flex items-center bg-primary-color-100 dark:bg-secondary-color-700 border-b border-primary-color-200 dark:border-secondary-color-600">
        <img src="{{ $publicacao->user->profile_photo_url }}" alt="{{ $publicacao->user->name }}"
            class="w-12 h-12 rounded-full">
        <div class="ml-4">
            <h2 class="text-base font-semibold text-primary-color-900 dark:text-secondary-color-50">{{ $publicacao->user->name }}</h2>
            <span
                class="text-sm text-primary-color-600 dark:text-secondary-color-400">{{ \Carbon\Carbon::parse($publicacao->created_at)->diffForHumans() }}</span>
        </div>
    </div>

    <!-- Conteúdo da Publicação -->
    <div class="px-6 py-5">
        <h3 class="text-lg font-semibold text-primary-color-900 dark:text-secondary-color-50">{{ $publicacao->titulo }}</h3>
        <p class="text-primary-color-600 dark:text-secondary-color-50 mt-4">{{ $publicacao->conteudo }}</p>

        @if(isset($publicacao->midia_id))
        @if($publicacao->midia?->tipo == "imagem")
        <div class="mt-5 flex shadow-sm">
            <img src="{{ $publicacao->midia->getMediaUrl() }}" alt="Imagem de Publicação"
                class=" max-w-full w-full object-cover shadow-sm">
        </div>
        @elseif($publicacao->midia?->tipo == "video")
        <div class="mt-5 flex justify-center">
            <video class="w-full shadow-md" controls>
                <source src="{{ $publicacao->midia->getMediaUrl() }}"
                    type="video/{{ $publicacao->midia->getMediaExtension() }}">
                Seu navegador não suporta vídeos HTML5.
            </video>
        </div>
        @endif
        @endif
    </div>

    <!-- Área de Interação -->
    <div class="border-t border-primary-color-200 dark:border-secondary-color-600">
        <div class="px-6 py-3 flex justify-between items-center w-full">
            <!-- Botões de Reação -->
            <div class="flex items-center space-x-3">
                <button
                    @auth
                    wire:click="reagirPublicacao"
                    @endauth
                    class="flex items-center text-red-500 hover:text-red-600 group">
                    @if(auth()->check() && auth()->user()->Reagiu($publicacao->id))
                    <x-bladewind::icon name="heart"
                        class="!h-6 !w-6 text-black !fill-red-600 !stroke-red-600" />
                    <span class="ml-1 text-base">
                        @else
                        <x-bladewind::icon name="heart"
                            class="!h-6 !w-6 !fill-none group-hover:!stroke-red-600 !stroke-primary-color-600 dark:!stroke-secondary-color-50" />
                        <span
                            class="ml-1 text-base text-primary-color-600 dark:text-secondary-color-50 group-hover:text-red-600">
                            @endif
                            {{ $publicacao->reacoes->where('like', true)->count() }}</span>
                </button>
            </div>

            <div class="flex items-center space-x-3">
                <!-- Botão de Comentários -->
                <button wire:click="toggleComentarios"
                    class="flex items-center text-primary-color-600 dark:text-secondary-color-50 hover:text-primary-color-800 dark:hover:text-secondary-color-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                    </svg>
                    <span class="ml-1 text-base">{{ $publicacao->comentarios->count() }}</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Seção de Comentários -->
    @if ($mostrarComentarios)
    <!-- Componente de Comentários -->
    @livewire('comentarios', ['publicacaoId' => $publicacao->id])
    @endif
</div>
