<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class FollowButton extends Component
{
    public User $user; // O usuário a ser seguido/desseguido
    public bool $isFollowing = false; // Estado inicial

    public function mount(User $user)
    {
        $this->user = $user;
        if (auth()->check()) {
        $this->isFollowing = auth()->user()->isFollowing($user); // Verifica se está seguindo
        }
    }

    public function toggleFollow()
    {
        if ($this->isFollowing) {
            auth()->user()->unfollow($this->user); // Desseguir
            $this->isFollowing = false;
        } else {
            auth()->user()->follow($this->user); // Seguir
            $this->isFollowing = true;
        }
    }

    public function render()
    {
        return view('livewire.follow-button');
    }

    public function redirectToLogin()
    {
        return redirect()->route('login');
    }
}
