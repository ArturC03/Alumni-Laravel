<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ListaUsers extends Component
{
    public $searchQuery = '';

    public $hasSearchInput = true;

    public $users = [];

    public function updateUsers()
    {
        if ($this->searchQuery === '') {
            $this->users = User::all();

            return;
        }
        $this->users = User::query()
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($query) {
                    $query->where('nickname', 'like', "%{$this->searchQuery}%")
                        ->orWhere('name', 'like', "%{$this->searchQuery}%")
                        ->orWhere('email', 'like', "%{$this->searchQuery}%");
                });
            })
            ->get();
    }

    public function mount($searchQuery = '')
    {
        $this->searchQuery = $searchQuery;
        $this->updateUsers();
    }

    public function render()
    {
        return view('livewire.lista-users', [
            'users' => $this->users,
        ]);
    }
}
