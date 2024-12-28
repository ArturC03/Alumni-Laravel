<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{

    protected $fillable = [
        'publicacao_id',
        'comentario_pai_id',
        'user_id',
        'conteudo',
        'ativo',
    ];

    // Relacionamento com publicação
    public function publicacao()
    {
        return $this->belongsTo(Publicacao::class);
    }

    // Relacionamento com visibilidade
    public function visibilidade()
    {
        return $this->belongsTo(Visibilidade::class);
    }

    // Relacionamento com o autor
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Comentário pai
    public function comentarioPai()
    {
        return $this->belongsTo(Comentario::class, 'comentario_pai_id');
    }

    // Comentários filhos
    public function comentariosFilhos()
    {
        return $this->hasMany(Comentario::class, 'comentario_pai_id');
    }

    // Reações ao comentário
    public function reacoes()
    {
        return $this->hasMany(Reacao::class, 'comentario_id');
    }
}
