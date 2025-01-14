<div>
    <input type="text" wire:in="searchQuery" placeholder="Buscar usuários...">
    @forelse ($users as $user)
    <livewire:follow-cartao :user="$user"/>
    @empty
        <p>Nenhum utilizador encontrado</p>
    @endforelse
</div>
