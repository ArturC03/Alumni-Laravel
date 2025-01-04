<x-app-layout>
    <div class="py-12 bg-primary-50 dark:bg-secondary-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($publicacao->CanBeViewedBy(auth()->user()))
            <div class="bg-white dark:bg-secondary-500 rounded-xl shadow-lg overflow-hidden">
                <!-- Author Section -->
                <div class="border-b border-primary-100 dark:border-secondary-400">
                    <livewire:author-info :author="$publicacao->user" />
                </div>

                <!-- Publication Content -->
                <div class="px-8 py-6 space-y-6">
                    <!-- Title and Metadata -->
                    <div class="space-y-4">
                        <h1 class="text-3xl font-semibold text-secondary-500 dark:text-white font-serif">
                            {{ $publicacao->titulo }}
                        </h1>
                        <div class="flex items-center space-x-4 text-sm text-secondary-400 dark:text-secondary-200">
                            <span class="flex items-center">
                                <x-bladewind::icon name="clock" class="!h-4 !w-4 mr-1" />
                                {{ $publicacao->created_at->format('d/m/Y H:i') }}
                            </span>
                            <span class="flex items-center">
                                <x-bladewind::icon name="eye" class="!h-4 !w-4 mr-1" />
                                {{ $publicacao->PublicacaoVisualizacoesCount() }} visualizações
                            </span>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="text-secondary-400 dark:text-secondary-100 leading-relaxed font-sans text-lg">
                        {!! nl2br(e($publicacao->conteudo)) !!}
                    </div>

                    <!-- Media Section -->
                    @if(isset($publicacao->midia_id))
                        @if($publicacao->midia?->tipo == "imagem")
                        <div class="mt-6 rounded-xl overflow-hidden">
                            <img
                                src="{{ $publicacao->midia->getMediaUrl() }}"
                                alt="Imagem de Publicação"
                                class="w-full object-cover hover:opacity-95 transition-opacity">
                        </div>
                        @elseif($publicacao->midia?->tipo == "video")
                        <div class="mt-6 rounded-xl overflow-hidden bg-secondary-800">
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
                <div class="border-t border-primary-100 dark:border-secondary-400">
                    <div class="px-8 py-4 flex justify-start space-x-8">
                        <!-- Reaction Button -->
                        <button
                            @auth
                            wire:click="reagirPublicacao"
                            @endauth
                            class="relative flex items-center space-x-3 group">
                            <div class="relative flex justify-center items-center">
                                @if(auth()->check() && auth()->user()->Reagiu($publicacao->id))
                                <x-bladewind::icon
                                    name="heart"
                                    class="!h-6 !w-6 !fill-primary-500 !stroke-primary-500
                                        transition-transform duration-150 ease-in-out transform
                                        group-active:scale-90 group-active:opacity-80" />
                                @else
                                <x-bladewind::icon
                                    name="heart"
                                    class="!h-6 !w-6 !fill-none group-hover:!stroke-primary-500
                                        !stroke-secondary-300 dark:!stroke-secondary-200
                                        transition-all duration-300 ease-in-out
                                        group-active:scale-90 group-active:opacity-80" />
                                @endif
                                <span class="absolute top-1/2 left-1/2 h-0 w-0 rounded-full bg-primary-500 opacity-0
                                        group-hover:h-10 group-hover:w-10 group-hover:opacity-25
                                        transition-all duration-200 ease-in-out -translate-x-1/2 -translate-y-1/2">
                                </span>
                            </div>
                            <span class="text-secondary-300 dark:text-secondary-200 group-hover:text-primary-500 font-medium">
                                {{ $publicacao->reacoes->where('like', true)->count() }}
                            </span>
                        </button>

                        <!-- Comments Count -->
                        <div class="flex items-center space-x-3">
                            <div class="relative flex justify-center items-center">
                                <x-bladewind::icon
                                    name="chat-bubble-left-right"
                                    class="!h-6 !w-6 !text-secondary-300 dark:!text-secondary-200" />
                            </div>
                            <span class="text-secondary-300 dark:text-secondary-200 font-medium">
                                {{ $publicacao->comentarios->count() }}
                            </span>
                        </div>

                        <!-- Share Button -->
                        <button
                            wire:click="compartilharPublicacao"
                            class="relative flex items-center space-x-3 group">
                            <div class="relative flex justify-center items-center">
                                <x-bladewind::icon
                                    name="share"
                                    class="!h-6 !w-6 !text-secondary-300 dark:!text-secondary-200 transition-colors
                                        group-hover:!text-primary-500 z-10" />
                                <span class="absolute top-1/2 left-1/2 h-0 w-0 rounded-full bg-primary-500 opacity-0
                                        group-hover:h-10 group-hover:w-10 group-hover:opacity-15
                                        transition-all duration-100 ease-in-out -translate-x-1/2 -translate-y-1/2">
                                </span>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="border-t border-primary-100 dark:border-secondary-400">
                    <div class="px-8 py-6">
                        <h3 class="text-xl font-semibold text-secondary-500 dark:text-white mb-6">
                            Comentários ({{ $publicacao->comentarios->count() }})
                        </h3>
                        @livewire('comentarios', ['publicacaoId' => $publicacao->id])
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white dark:bg-secondary-500 rounded-xl shadow-lg p-8 text-center">
                <h2 class="text-2xl font-semibold text-secondary-500 dark:text-white">
                    Você não tem permissão para visualizar esta publicação.
                </h2>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
