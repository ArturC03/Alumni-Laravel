<div onclick="event.stopPropagation();" wire:poll.5s class="border-t border-gray-200 dark:border-secondary-700 px-4 py-3">
    @auth
        <!-- Campo para adicionar um novo comentário -->
        <div class="flex items-start space-x-3 mb-5">
            <!-- Foto do Usuário -->
            <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full">
            <!-- Área de Texto -->
            <div class="flex-grow">
                <x-textarea
                    id="novoComentario"
                    name="novoComentario"
                    wire:model.defer="novoComentario"
                    rows="2"
                    placeholder="Escreva um comentário..."
                ></x-textarea>
                <div class="text-right mt-2">
                    <x-button
                        wire:click="salvarComentario">
                        Enviar
                    </x-button>
                </div>
            </div>
        </div>
    @endauth

    <!-- Lista de Comentários -->
    <div class="space-y-5">
        @forelse ($comentarios as $comentario)
            <div class="flex items-start space-x-3">
                <!-- Foto do autor -->
                <img src="{{ $comentario->user->profile_photo_url }}" alt="{{ $comentario->user->name }}" class="w-8 h-8 rounded-full">
                <!-- Corpo do Comentário -->
                <div class="bg-white dark:bg-secondary-700 w-full rounded-md shadow-sm p-3">
                    <div class="flex justify-between items-center">
                        <h4 class="font-semibold text-sm text-gray-800 dark:text-secondary-50">{{ $comentario->user->name }}</h4>
                        <span class="text-xs text-gray-500 dark:text-secondary-400">{{ $comentario->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-700 dark:text-secondary-200 text-sm mt-2">{{ $comentario->conteudo }}</p>
                </div>
            </div>

            <!-- Comentários Filhos (Respostas) -->
            @if ($comentario->comentariosFilhos->isNotEmpty())
                <div class="ml-10 mt-3 space-y-5">
                    @foreach ($comentario->comentariosFilhos as $resposta)
                        <div class="flex items-start space-x-3">
                            <!-- Foto do autor -->
                            <img src="{{ $resposta->user->profile_photo_url }}" alt="{{ $resposta->user->name }}" class="w-7 h-7 rounded-full">
                            <!-- Corpo da Resposta -->
                            <div class="bg-gray-100 dark:bg-secondary-800 w-full rounded-md shadow-sm p-3">
                                <div class="flex justify-between items-center">
                                    <h4 class="font-semibold text-sm text-gray-800 dark:text-secondary-50">{{ $resposta->user->name }}</h4>
                                    <span class="text-xs text-gray-500 dark:text-secondary-400">{{ $resposta->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700 dark:text-secondary-200 text-sm mt-2">{{ $resposta->conteudo }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @empty
            <p class="text-center text-gray-500 dark:text-secondary-400 text-sm">
                Nenhum comentário ainda. Seja o primeiro a comentar!
            </p>
        @endforelse
    </div>
</div>
