<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class AuthorInfo extends Component
{
    public $author;
    public $isFollowing = false;
    public $nickname;

    public function mount(User $author): void
    {
        $this->author = $author;
        $this->isFollowing = auth()->user()->isFollowing($author) ?? false;
        $this->nickname = $author->nickname;
    }


    public function render()
    {
        return view('livewire.author-info');
    }
}
