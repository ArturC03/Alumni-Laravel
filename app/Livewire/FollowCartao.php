<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowCartao extends Component
{
    protected $rules = [
        'user' => 'required|exists:users,id',
    ];

    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        if (auth()->check()) {
            if ($this->user->id == auth()->user()->id) {
                return '<div></div>';
            }
        }

        return view('livewire.follow-cartao', [
            'user' => $this->user,
        ]);
    }
}
