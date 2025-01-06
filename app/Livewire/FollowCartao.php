<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowCartao extends Component
{
    protected $rules = [
        'User' => 'required|exists:users,id',
    ];

    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.follow-cartao', [
            'user' => $this->user,
        ]);
    }
}
