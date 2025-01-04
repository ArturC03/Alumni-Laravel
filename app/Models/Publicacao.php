<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{
    protected $table = 'publicacoes';

    protected $fillable = ['titulo', 'conteudo', 'ativo', 'midia_id', 'user_id', 'visibilidade_id'];

    protected $primaryKey = 'id';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function midia()
    {
        return $this->belongsTo(Midia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function visibilidade()
    {
        return $this->belongsTo(Visibilidade::class);
    }

    public function reacoes()
    {
        return $this->hasMany(Reacao::class);
    }

    public function publicacaoVisualizacoes()
    {
        return $this->hasMany(PublicacaoVisualizacao::class);
    }

    public function isPublic()
    {
        return $this->visibilidade->estado == 'Público';
    }

    public function isArchived()
    {
        return $this->visibilidade->estado == 'Arquivado';
    }

    public function isPrivate()
    {
        return $this->visibilidade->estado == 'Privado';
    }

    public function PublicacaoVisualizacoesCount()
    {
        return $this->publicacaoVisualizacoes()->count();
    }

    // No modelo Publicacao
    public function canBeViewedBy(?User $user): bool
    {
        if (! isset($user)) {
            return false;
        }
        // Visível para todos
        if ($this->isPublic()) {
            return true;
        }

        // Arquivada ou privada, mas pertence ao usuário autenticado
        if (($this->isArchived() || $this->isPrivate()) && $user->id === $this->user_id) {
            return true;
        }

        // O usuário autenticado está a seguir o autor
        if ($user->isFollowing($this->user) && $this->isPrivate()) {
            return true;
        }

        return false;
    }
}
