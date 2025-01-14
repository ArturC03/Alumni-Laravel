<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="mx-auto flex flex-col lg:flex-row gap-6">
            <!-- Alimentação Principal -->
            <section class="mx-auto flex-grow w-full lg:max-w-[calc(100%-320px)]">
                <!-- Perfil do Utilizador -->
                <div class="mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-sm mb-6 overflow-hidden">
                    <!-- Imagem de Capa -->
                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-700">
                        @if($user->cover_photo)
                        <img
                            src="{{ Storage::url($user->cover_photo) }}"
                            alt="Imagem de capa"
                            class="w-full h-full object-cover">
                        @endif
                    </div>

                    <!-- Informações do Perfil -->
                    <div class="px-6 pb-6">
                        <div class="flex justify-between items-start -mt-16">
                            <!-- Foto de Perfil -->
                            <div class="relative">
                                <img
                                    src="{{ $user->profile_photo_url }}"
                                    alt="Foto de perfil"
                                    class="w-32 h-32 rounded-full border-4 border-white dark:border-gray-800 object-cover">
                            </div>

                            <!-- Botões de Ação -->
                            <div class="mt-16 flex gap-3">
                                @auth
                                @if(auth()->id() === $user->id)
                                <a
                                    href="{{ route('profile.show') }}"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600
                                                   rounded-full text-sm font-medium text-gray-700 dark:text-gray-200
                                                   bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700
                                                   transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Editar perfil
                                </a>
                                @else
                                @livewire('follow-button', ['user' => $user])
                                @endif
                                @endauth
                            </div>
                        </div>

                        <!-- Nome e Informações -->
                        <div class="mt-4">
                            <h1 class="text-xl font-bold text-gray-900 dark:text-white">
                                {{ $user->name }}
                            </h1>
                            <p class="text-gray-500 dark:text-gray-400">
                                @ {{ $user->nickname }}
                            </p>
                            @if($user->bio)
                            <p class="mt-2 text-gray-600 dark:text-gray-300">
                                {{ $user->bio }}
                            </p>
                            @endif
                        </div>

                        <!-- Estatísticas -->
                        <div class="mt-4 flex gap-6">
                            <a href="#publicacoes" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                <span class="font-bold">{{ $user->publicacoes->count() }}</span>
                                <span>Publicações</span>
                            </a>
                            <a href="#seguidores" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                <span class="font-bold">{{ $user->followers->count() }}</span>
                                <span>Seguidores</span>
                            </a>
                            <a href="#seguindo" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                <span class="font-bold">{{ $user->following->count() }}</span>
                                <span>A seguir</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Publicações -->
                <div class="space-y-4">
                    @forelse($publicacoes as $publicacao)
                    <div class="rounded-lg shadow-sm">
                        <livewire:publicacao-cartao
                            :publicacao="$publicacao"
                            wire:key="publicacao-{{ $publicacao->id }}" />
                    </div>
                    @empty
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2zM12 8v4M12 16h.01" />
                        </svg>
                        <p class="mt-4 text-gray-500 dark:text-gray-400">
                            Ainda não há publicações para mostrar.
                        </p>
                    </div>
                    @endforelse
                </div>
            </section>

        </div>
    </main>
</x-app-layout>
