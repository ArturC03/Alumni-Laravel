<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class AuthorInfo extends Component
{
    public $author;

    public $nickname;

    public function mount(User $author): void
    {
        $this->author = $author;
        $this->nickname = $author->nickname;
    }

    public function render()
    {
        return view('livewire.author-info');
    }
}
