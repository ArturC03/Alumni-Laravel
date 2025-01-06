<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class AuthorInfo extends Component
{
    public $author;

    public function mount(User $author): void
    {
        $this->author = $author;
    }

    public function render()
    {
        return view('livewire.author-info');
    }
}
