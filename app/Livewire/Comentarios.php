<?php

namespace App\Livewire;

use App\Models\Comentario;
use App\Models\Publicacao;
use Livewire\Component;

class Comentarios extends Component
{
    public $publicacaoId; // Para identificar a publicação atual.
    public $novoComentario; // Para armazenar o texto do novo comentário.
    public $comentarios; // Comentários carregados para exibição.

    // Regras de validação
    protected $rules = [
        'novoComentario' => 'required|string|max:500',
    ];

    // Carrega os comentários quando o componente é iniciado
    public function mount($publicacaoId)
    {
        $this->publicacaoId = $publicacaoId;
        $this->carregarComentarios();
    }

    // Carrega os comentários da publicação
    public function carregarComentarios()
    {
        $this->comentarios = Comentario::where('publicacao_id', $this->publicacaoId)
            ->whereNull('comentario_pai_id') // Apenas comentários principais
            ->with('comentariosFilhos', 'user') // Carrega as respostas e o autor
            ->latest()
            ->get();
    }

    // Salva um novo comentário
    public function salvarComentario()
    {
        $this->validate(); // Valida o conteúdo do novo comentário

        Comentario::create([
            'publicacao_id' => $this->publicacaoId,
            'user_id' => auth()->id(), // Usuário autenticado
            'conteudo' => $this->novoComentario,
            'ativo' => true, // Define o comentário como ativo
        ]);

        $this->novoComentario = ''; // Limpa o campo
        $this->carregarComentarios(); // Recarrega os comentários
    }

    public function render()
    {
        return view('livewire.comentarios');
    }
}
