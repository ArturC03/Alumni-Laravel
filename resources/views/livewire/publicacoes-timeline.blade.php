<div>
    <!-- Botão de Carregamento Inicial -->
    @if (!$readyToLoad)
        <div class="flex justify-center">
            <x-button
                wire:click="loadPublicacoes"
                class="">
                Carregar Publicações
            </x-button>
        </div>
    @endif

    <!-- Lista de Publicações -->
    @if ($readyToLoad)
        <div class="space-y-6">
            @forelse ($publicacoes as $publicacao)
                <livewire:publicacao-cartao :publicacao="$publicacao" :key="'publicacao-'.$publicacao->id" />
            @empty
                <p class="text-gray-500 text-center mt-6">Nenhuma publicação encontrada.</p>
            @endforelse
        </div>
    @endif
</div>
