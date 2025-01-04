<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visibilidade extends Model
{
    protected $table = 'visibilidades';

    protected $fillable = ['estado'];

    protected $guarded = ['id'];

    public $timestamps = true;

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function publicacao()
    {
        return $this->hasMany(Publicacao::class);
    }
}
