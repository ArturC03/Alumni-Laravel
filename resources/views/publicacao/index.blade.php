<x-app-layout>
    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($publicacao->CanBeViewedBy(auth()->user()))
            <livewire:publicacao-cartao :publicacao="$publicacao" :mostrarComentarios="true"/>
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
