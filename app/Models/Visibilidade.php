<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class visibilidade extends Model
{
    protected $table = 'visibilidades';
    protected $fillable = ['nome'];
    protected $guarded = ['id'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function publicacao() {
        return $this->belongsTo(Publicacao::class);
    }
}
