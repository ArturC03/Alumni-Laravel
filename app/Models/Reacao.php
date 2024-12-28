<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reacao extends Model
{

    // Nome da tabela no banco de dados
    protected $table = 'reacoes';

    // Campos que podem ser preenchidos em massa via Eloquent
    protected $fillable = [
        'publicacao_id',   // ID da publicação associada (se aplicável)
        'comentario_id',   // ID do comentário associado (se aplicável)
        'user_id',         // ID do usuário que deu a reação
        'like',            // Booleano: true para like, false para dislike
    ];

    /**
     * Relacionamento com a publicação (uma reação pode pertencer a uma publicação).
     */
    public function publicacao()
    {
        return $this->belongsTo(Publicacao::class, 'publicacao_id');
    }

    /**
     * Relacionamento com o comentário (uma reação pode pertencer a um comentário).
     */
    public function comentario()
    {
        return $this->belongsTo(Comentario::class, 'comentario_id');
    }

    /**
     * Relacionamento com o usuário (quem deu a reação).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
