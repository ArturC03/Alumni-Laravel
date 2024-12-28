<?php

namespace App\Livewire;

use App\Models\Publicacao;
use Livewire\Component;

class PublicacaoCartao extends Component
{
    // Variáveis públicas
    public $publicacao; // Objeto da publicação completa recebido da view
    public $mostrarComentarios = false; // Indica se os comentários estão visíveis para esta instância

    /**
     * Montar o componente recebendo a publicação.
     * Usado para inicializar as propriedades do componente.
     *
     * @param Publicacao $publicacao - Objeto da publicação
     */
    public function mount(Publicacao $publicacao)
    {
        $this->publicacao = $publicacao;
        $this->mostrarComentarios = false; // Inicializando como falso para cada componente
    }

    /**
     * Alternar a visibilidade dos comentários.
     */
    public function toggleComentarios()
    {
        $this->mostrarComentarios = !$this->mostrarComentarios;
    }

    /**
     * Método para reagir à publicação (like/dislike).
     *
     * @return void
     */
    public function reagirPublicacao()
    {
        $reacaoExistente = $this->publicacao->reacoes()
            ->where('user_id', auth()->id())
            ->first();

        if ($reacaoExistente) {
            // Atualizar a reação existente
            $reacaoExistente->update([
                'like' => !(auth()->user()->Reagiu($this->publicacao->id))
            ]);
        } else {
            // Criar uma nova reação
            $this->publicacao->reacoes()->create([
                'user_id' => auth()->id(),
                'like' => true,
            ]);
        }

        // Atualizar as reações da publicação
        $this->publicacao->load('reacoes');
    }

    /**
     * Método para reagir a um comentário.
     *
     * @param int $comentarioId - ID do comentário
     * @param bool $like - Verdadeiro para like, falso para dislike
     * @return void
     */
    public function reagirComentario($comentarioId, $like)
    {
        $comentario = $this->publicacao->comentarios()->find($comentarioId);

        if ($comentario) {
            $reacaoExistente = $comentario->reacoes()
                ->where('user_id', auth()->id())
                ->first();

            if ($reacaoExistente) {
                // Atualizar a reação existente
                $reacaoExistente->update(['like' => $like]);
            } else {
                // Criar uma nova reação
                $comentario->reacoes()->create([
                    'user_id' => auth()->id(),
                    'like' => $like,
                ]);
            }

            // Atualizar as reações do comentário
            $comentario->load('reacoes');
        }
    }

    /**
     * Renderizar a view do componente.
     */
    public function render()
    {
        return view('livewire.publicacao-cartao', [
            // Carregar os comentários apenas quando $mostrarComentarios for verdadeiro
            'comentarios' => $this->mostrarComentarios
                ? $this->publicacao->comentarios()->with('user', 'reacoes')->get()
                : [],
        ]);
    }
}
