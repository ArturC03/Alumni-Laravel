<x-app-layout>
    <main class="w-full">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Main Feed --}}
            <section class="flex-1 min-w-0">
                <div class="grid gap-6">
                    @forelse($publicacoes as $publicacao)
                    <div class="bg-white dark:bg-gray-800  shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <livewire:publicacao-cartao :publicacao="$publicacao" wire:key="publicacao-{{ $publicacao->id }}" />
                    </div>
                    @empty
                    <div class="bg-white dark:bg-gray-800  p-8 text-center">
                        <x-bladewind::icon type="calendar" class="w-12 h-12 mx-auto text-gray-400" />
                        <p class="mt-4 text-gray-500 dark:text-gray-400">
                            Nenhuma publicação encontrada.
                        </p>
                    </div>
                    @endforelse
                </div>
            </section>

            <!-- Sugestões e conteúdo adicional (coluna fixa direita) -->
            <aside class="w-64 col-span-1 lg:col-span-3 hidden lg:block">
                <div class="sticky top-6">
                    <!-- Exemplo de sugestões -->
                    <div class="border-2 border-gray-200 dark:border-secondary-color-800 bg-white dark:bg-secondary-color-900 rounded-lg shadow ">
                        <h2 class="pl-4 pt-4 text-lg font-semibold dark:bg-secondary-color-700 text-gray-900 dark:text-white pb-4">Sugestões</h2>
                        <!-- Aqui você pode incluir conteúdo, como sugestões de amigos -->
                        <ul class="">
                            @forelse ($sugestoes ?? [] as $user)
                            <div class="p-4 py-4 hover:bg-gray-50 dark:hover:bg-secondary-color-750 flex justify-between">
                                <li class="flex items-center space-x-4">
                                    <img class="h-10 w-10 rounded-full object-cover"
                                        src="{{ $user->profile_photo_url }}"
                                        alt="{{ $user->name }}">
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            @ {{ $user->nickname }}
                                        </p>
                                    </div>

                                </li>
                                <livewire:follow-button :user="$user" wire:key="follow-{{ $user->id }}" />
                            </div>
                            @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Nenhuma sugestão no momento.
                            </p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </main>
</x-app-layout>
