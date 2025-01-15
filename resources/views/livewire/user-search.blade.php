<div class="px-4 w-full max-w-[30rem] lg:w-[30rem]">
    <div class="mb-6">
        {{-- Campo de Pesquisa --}}
        <input
            type="text"
            wire:model.blur="search"
            placeholder="Pesquisar por nome, email ou nickname..."
            class="w-full border-secondary-300 dark:border-secondary-50 dark:bg-secondary text-secondary-800 dark:text-secondary-50 focus:border-primary-500 dark:focus:border-primary-500 focus:ring-primary-500 dark:focus:ring-primary-500 rounded-md shadow-md px-4 py-2"
        >
    </div>

    {{-- Resultados da Pesquisa --}}
    <div class="grid grid-cols-1 gap-6">
        @forelse ($users as $user)
            <livewire:follow-cartao :user="$user" :key="$user->id" />
        @empty
            <div class="text-center text-gray-500">
                <x-bladewind::icon type="user" class="w-12 h-12 mx-auto text-gray-400" />
                <p class="mt-4">Nenhum usuário encontrado</p>
            </div>
        @endforelse
    </div>
</div>

