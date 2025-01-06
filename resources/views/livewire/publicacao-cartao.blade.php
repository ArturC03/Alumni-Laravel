<div>
    @if($publicacao->CanBeViewedBy(auth()->user()))
        <div class="bg-white dark:bg-secondary-500 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all duration-200"
             {{ (url()->current() === route('publicacao.index', $publicacao)) ? '' : 'onclick="window.location=`' . route('publicacao.index', $publicacao) . '`"'}}>

            <!-- Informações do Autor -->
            <div>
                <livewire:author-info :author="$publicacao->user" />
            </div>

            <!-- Conteúdo da Publicação -->
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
                            <img src="{{ $publicacao->midia->getMediaUrl() }}" alt="Imagem de Publicação"
                                 class="w-full object-cover hover:opacity-95 transition-opacity">
                        </div>
                    @elseif($publicacao->midia?->tipo == "video")
                        <div class="mt-4 rounded-xl overflow-hidden bg-secondary-800">
                            <video class="w-full" controls poster="{{ $publicacao->midia->getThumbnailUrl() }}">
                                <source src="{{ $publicacao->midia->getMediaUrl() }}" type="video/{{ $publicacao->midia->getMediaExtension() }}">
                                Seu navegador não suporta vídeos HTML5.
                            </video>
                        </div>
                    @endif
                @endif
            </div>

            <!-- Área de Interação -->
            <div class="border-none border-primary-100 dark:border-secondary-400">
                <div class="px-6 pb-3 flex justify-around items-center">

                    <!-- Botão de Reação -->
                    <button @auth wire:click="reagirPublicacao" @endauth
                    onclick="event.stopPropagation();"
                            class="relative flex items-center space-x-2 group">
                        <div class="relative flex justify-center items-center">
                            @if(auth()->check() && auth()->user()->Reagiu($publicacao->id))
                                <x-bladewind::icon
                                    name="heart"
                                    class="!h-5 !w-5 !fill-primary-500 !stroke-primary-500 transition-transform duration-150 ease-in-out transform group-active:scale-90 group-active:opacity-80" />
                            @else
                                <x-bladewind::icon
                                    name="heart"
                                    class="!h-5 !w-5 !fill-none group-hover:!stroke-primary-500 !stroke-secondary-300 dark:!stroke-secondary-200 transition-all duration-300 ease-in-out group-active:scale-90 group-active:opacity-80" />
                            @endif
                            <span class="absolute top-1/2 left-1/2 h-0 w-0 rounded-full bg-primary-500 opacity-0 group-hover:h-8 group-hover:w-8 group-hover:opacity-25 transition-all duration-200 ease-in-out -translate-x-1/2 -translate-y-1/2">
                            </span>
                        </div>
                        <span class="text-secondary-300 dark:text-secondary-200 group-hover:text-primary-500 font-medium transition-colors duration-200 ease-in-out">
                            {{ $publicacao->reacoes->where('like', true)->count() }}
                        </span>
                    </button>

                    <!-- Botão de Comentários -->
                    <button wire:click="toggleComentarios" onclick="event.stopPropagation();" class="relative flex items-center space-x-2 group">
                        <div class="relative flex justify-center items-center">
                            <x-bladewind::icon
                                name="chat-bubble-left-right"
                                class="h-5 w-5 text-secondary-300 dark:text-secondary-200 group-hover:text-primary-500 transition-colors" />
                            <span class="absolute top-1/2 left-1/2 h-0 w-0 rounded-full bg-primary-500 opacity-0 group-hover:h-8 group-hover:w-8 group-hover:opacity-15 transition-all duration-100 ease-in-out -translate-x-1/2 -translate-y-1/2">
                            </span>
                        </div>
                        <span class="text-secondary-300 dark:text-secondary-200 group-hover:text-primary-500 font-medium transition-colors">
                            {{ $publicacao->comentarios->count() }}
                        </span>
                    </button>

                    <!-- Botão de Visualizações -->
                    <button wire:mouseover="VisualizarPublicacao" onclick="event.stopPropagation();" class="relative flex items-center space-x-2 group">
                        <div class="relative flex justify-center items-center">
                            <x-bladewind::icon
                                name="eye"
                                class="!h-5 !w-5 !text-secondary-300 dark:!text-secondary-200 transition-colors group-hover:!text-primary-500 z-10" />
                            <span class="absolute top-1/2 left-1/2 h-0 w-0 rounded-full bg-primary-500 opacity-0 group-hover:h-8 group-hover:w-8 group-hover:opacity-15 transition-all duration-100 ease-in-out -translate-x-1/2 -translate-y-1/2">
                            </span>
                        </div>
                        <span class="text-secondary-300 dark:text-secondary-200 group-hover:text-primary-500 font-medium transition-colors">
                            {{ $publicacao->PublicacaoVisualizacoesCount() }}
                        </span>
                    </button>

                    <!-- Botão de Compartilhamento -->
                    <button onclick="event.stopPropagation();" class="relative flex items-center space-x-2 group">
                        <div class="relative flex justify-center items-center">
                            <x-bladewind::icon
                                name="share"
                                class="!h-5 !w-5 !text-secondary-300 dark:!text-secondary-200 transition-colors group-hover:!text-primary-500 z-10" />
                            <span class="absolute top-1/2 left-1/2 h-0 w-0 rounded-full bg-primary-500 opacity-0 group-hover:h-8 group-hover:w-8 group-hover:opacity-15 transition-all duration-100 ease-in-out -translate-x-1/2 -translate-y-1/2">
                            </span>
                        </div>
                        <span class="text-secondary-300 dark:text-secondary-200 group-hover:text-primary-500 font-medium transition-colors">
                            0
                        </span>
                    </button>
                </div>
            </div>

            <!-- Seção de Comentários -->
            @if($mostrarComentarios)
                <div class="border-t border-primary-100 dark:border-secondary-400">
                    @livewire('comentarios', ['publicacaoId' => $publicacao->id])
                </div>
            @endif
        </div>
    @endif
</div>
