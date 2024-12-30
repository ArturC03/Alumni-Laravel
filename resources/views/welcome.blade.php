<x-app-layout>
    <main class="mx-auto">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Main Feed --}}
            <section class="flex-1 min-w-0">
                eardiv class="grid gap-6 justify-items-center">
                @forelse($publicacoes as $publicacao)
                <div class="my-4 max-w-md min-w-[20rem]">
                    <livewire:publicacao-cartao :publicacao="$publicacao" wire:key="publicacao-{{ $publicacao->id }}" />
                </div> @empty
                <div class="">
                    <x-bladewind::icon type="calendar" class="w-12 h-12 mx-auto text-gray-400" />
                    <p class="mt-4 text-gray-500 ">
                        Nenhuma publicação encontrada.
                    </p>
                </div>
                @endforelse
        </div>
        </section>

        <!-- Sugestões e conteúdo adicional (coluna fixa direita) -->
        <!--<aside class="w-64 col-span-1 lg:col-span-3 hidden lg:block">-->
        <!--    <div class="sticky top-6">-->
        <!--        <!-- Exemplo de sugestões -->
        <!--        <div class="border-2 border-gray-200 dark:border-secondary-800 bg-white dark:bg-secondary-900 rounded-lg shadow ">-->
        <!--            <h2 class="pl-4 pt-4 text-lg font-semibold dark:bg-secondary-700 text-gray-900 dark:text-white pb-4">Sugestões</h2>-->
        <!--            <!-- Aqui você pode incluir conteúdo, como sugestões de amigos -->
        <!--            <ul class="">-->
        <!--                @forelse ($sugestoes ?? [] as $user)-->
        <!--                <div class="p-4 py-4 hover:bg-gray-50 dark:hover:bg-secondary-750 flex justify-between">-->
        <!--                    <li class="flex items-center space-x-4">-->
        <!--                        <img class="h-10 w-10 rounded-full object-cover"-->
        <!--                            src="{{ $user->profile_photo_url }}"-->
        <!--                            alt="{{ $user->name }}">-->
        <!--                        <div>-->
        <!--                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h4>-->
        <!--                            <p class="text-xs text-gray-500 dark:text-gray-400">-->
        <!--                                @ {{ $user->nickname }}-->
        <!--                            </p>-->
        <!--                        </div>-->
        <!---->
        <!--                    </li>-->
        <!--                    <livewire:follow-button :user="$user" wire:key="follow-{{ $user->id }}" />-->
        <!--                </div>-->
        <!--                @empty-->
        <!--                <p class="text-sm text-gray-500 dark:text-gray-400">-->
        <!--                    Nenhuma sugestão no momento.-->
        <!--                </p>-->
        <!--                @endforelse-->
        <!--            </ul>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</aside>-->
        </div>
    </main>
</x-app-layout>
