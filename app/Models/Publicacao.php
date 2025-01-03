<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{
    protected $table = 'publicacoes';

    protected $fillable = ['titulo', 'conteudo', 'ativo', 'midia_id', 'user_id', 'visibilidade_id'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function isPublic()
    {
        return $this->visibilidade->nome == 'Público';
    }

    public function visibilidade()
    {
        return $this->hasMany(Visibilidade::class);
    }

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

    public function reacoes()
    {
        return $this->hasMany(Reacao::class);
    }

    public function publicacaoVisualizacoes()
    {
        return $this->hasMany(PublicacaoVisualizacao::class);
    }

    public function PublicacaoVisualizacoesCount()
    {
        return $this->publicacaoVisualizacoes()->count();
    }
}
