<?php

namespace App\Livewire;

use App\Models\Publicacao;
use Livewire\Component;

class PublicacoesTimeline extends Component
{
    public $user;
    public $publicacoes = [];
    public $readyToLoad = false;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function loadPublicacoes()
    {
        $this->readyToLoad = true;
        $this->publicacoes = Publicacao::with('user', 'midia')
            ->where('user_id', $this->user)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.publicacoes-timeline', [
            'publicacoes' => $this->readyToLoad ? $this->publicacoes : [],
        ]);
    }
}
