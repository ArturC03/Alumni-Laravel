<div class="bg-white dark:bg-secondary-500 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all duration-200">
    <div>
        <livewire:author-info :author="$publicacao->user" />
    </div>

    <!-- Publication Content -->
    <div class="px-6 py-2 space-y-4">
        <h3 class="text-xl font-semibold text-secondary-500 dark:text-white font-serif">
            {{ $publicacao->titulo }}
        </h3>
        <p class="text-secondary-400 dark:text-secondary-100 leading-relaxed font-sans">
            {{ $publicacao->conteudo }}
        </p>

        @if(isset($publicacao->midia_id))
        @if($publicacao->midia?->tipo == "imagem")
        <div class="mt-4 rounded-xl overflow-hidden">
            <img
                src="{{ $publicacao->midia->getMediaUrl() }}"
                alt="Imagem de Publicação"
                class="w-full object-cover hover:opacity-95 transition-opacity">
        </div>
        @elseif($publicacao->midia?->tipo == "video")
        <div class="mt-4 rounded-xl overflow-hidden bg-secondary-800">
            <video
                class="w-full"
                controls
                poster="{{ $publicacao->midia->getThumbnailUrl() }}">
                <source
                    src="{{ $publicacao->midia->getMediaUrl() }}"
                    type="video/{{ $publicacao->midia->getMediaExtension() }}">
                Seu navegador não suporta vídeos HTML5.
            </video>
        </div>
        @endif
        @endif
    </div>

    <!-- Interaction Area -->
    <div class="border-none border-primary-100 dark:border-secondary-400">
        <div class="px-6 pb-3 flex justify-around items-center">

            <!-- Reaction Button -->
            <button
                @auth
                wire:click="reagirPublicacao"
                @endauth
                class="relative flex items-center space-x-2 group">
                <!-- Container do ícone -->
                <div class="relative flex justify-center items-center">
                    @if(auth()->check() && auth()->user()->Reagiu($publicacao->id))
                    <x-bladewind::icon
                        name="heart"
                        class="!h-5 !w-5 !fill-primary-500 !stroke-primary-500 transition-colors" />
                    @else
                    <x-bladewind::icon
                        name="heart"
                        class="!h-5 !w-5 !fill-none group-hover:!stroke-primary-500 !stroke-secondary-300 dark:!stroke-secondary-200 transition-colors" />
                    @endif
                    <!-- Círculo que aparece no hover -->
                    <span
                        class="absolute top-1/2 left-1/2 h-0 w-0 rounded-full bg-primary-500 opacity-0
                               group-hover:h-8 group-hover:w-8 group-hover:opacity-15
                               transition-all duration-100 ease-in-out -translate-x-1/2 -translate-y-1/2">
                    </span>
                </div>
                <span class="text-secondary-300 dark:text-secondary-200 group-hover:text-primary-500 font-medium transition-colors">
                    {{ $publicacao->reacoes->where('like', true)->count() }}
                </span>
            </button>

            <!-- Comments Button -->
            <button
                wire:click="toggleComentarios"
                class="relative flex items-center space-x-2 group">
                <!-- Container do ícone -->
                <div class="relative flex justify-center items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-secondary-300 dark:text-secondary-200 group-hover:text-primary-500 transition-colors"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                    </svg>
                    <!-- Círculo que aparece no hover -->
                    <span
                        class="absolute top-1/2 left-1/2 h-0 w-0 rounded-full bg-primary-500 opacity-0
                               group-hover:h-8 group-hover:w-8 group-hover:opacity-15
                               transition-all duration-100 ease-in-out -translate-x-1/2 -translate-y-1/2">
                    </span>
                </div>
                <span class="text-secondary-300 dark:text-secondary-200 group-hover:text-primary-500 font-medium transition-colors">
                    {{ $publicacao->comentarios->count() }}
                </span>
            </button>


            <!-- Views Button -->
            <button
    wire:mouseover="VisualizarPublicacao"
                class="relative flex items-center space-x-2 group">
                <!-- Container do ícone -->
                <div class="relative flex justify-center items-center">
                    <x-bladewind::icon
                        name="eye"
                        class="!h-5 !w-5 !text-secondary-300 dark:!text-secondary-200 transition-colors
                               group-hover:!text-primary-500 z-10" />
                    <!-- Círculo que aparece no hover -->
                    <span
                        class="absolute top-1/2 left-1/2 h-0 w-0 rounded-full bg-primary-500 opacity-0
                               group-hover:h-8 group-hover:w-8 group-hover:opacity-15
                               transition-all duration-100 ease-in-out -translate-x-1/2 -translate-y-1/2">
                    </span>
                </div>
                <span class="text-secondary-300 dark:text-secondary-200 group-hover:text-primary-500 font-medium transition-colors">
                    {{ $publicacao->PublicacaoVisualizacoesCount() }}
                </span>
            </button>

            <!-- Share Button -->
            <button
                wire:click=""
                class="relative flex items-center space-x-2 group">
                <!-- Container do ícone -->
                <div class="relative flex justify-center items-center">
                    <x-bladewind::icon
                        name="share"
                        class="!h-5 !w-5 !text-secondary-300 dark:!text-secondary-200 transition-colors
                               group-hover:!text-primary-500 z-10" />
                    <!-- Círculo que aparece no hover -->
                    <span
                        class="absolute top-1/2 left-1/2 h-0 w-0 rounded-full bg-primary-500 opacity-0
                               group-hover:h-8 group-hover:w-8 group-hover:opacity-15
                               transition-all duration-100 ease-in-out -translate-x-1/2 -translate-y-1/2">
                    </span>
                </div>
                <span class="text-secondary-300 dark:text-secondary-200 group-hover:text-primary-500 font-medium transition-colors">
                    0
                </span>
            </button>

        </div>
    </div>

    <!-- Comments Section -->
    @if ($mostrarComentarios)
    <div class="border-t border-primary-100 dark:border-secondary-400">
        @livewire('comentarios', ['publicacaoId' => $publicacao->id])
    </div>
    @endif
</div>
