<div>
    <div class="mb-4">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Pesquisar por nome, email ou nickname..."
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($users as $user)
            <livewire:follow-cartao :user="$user" :key="$user->id" />
        @empty
            <div class="col-span-full text-center text-gray-500">
                Nenhum usuário encontrado
            </div>
        @endforelse
    </div>
</div>
