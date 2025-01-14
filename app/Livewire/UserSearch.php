<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserSearch extends Component
{
    public $search = '';

    // Adicionar um listener para mudanças no search
    public function updatedSearch()
    {
        // Podemos usar isso para debug
        logger('Search value updated: '.$this->search);
    }

    public function render()
    {
        $users = User::where(function ($query) {
            $query->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('email', 'like', '%'.$this->search.'%')
                ->orWhere('nickname', 'like', '%'.$this->search.'%');
        })
            ->get();

        // Debug para ver os usuários retornados
        logger('Users found: '.$users->count());

        return view('livewire.user-search', [
            'users' => $users,
        ]);
    }
}
