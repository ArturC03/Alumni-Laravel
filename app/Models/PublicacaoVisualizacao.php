<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicacaoVisualizacao extends Model
{
    protected $table = 'publicacao_visualizacoes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'publicacao_id',
        'user_id',
    ];

    public $timestamps = true;

    public function publicacao()
    {
        return $this->belongsTo(Publicacao::class);
    }

    // Relacionamento com User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
