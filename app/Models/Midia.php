<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Midia extends Model
{

    protected $table = 'midias';
    protected $fillable = ['tipo', 'media_path'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public $timestamps = true;

    public function getMediaExtension() {
        return pathinfo($this->media_path)['extension'];
    }
    public function getMediaUrl()
    {
        return Storage::url($this->media_path);
    }

    public static function detetarTipoMidia(string $fileExtension): string
    {
        $tiposVideo = ['mp4', 'avi', 'mov', 'mkv'];
        $tiposImagem = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $tiposVideo)) {
            return 'video';
        }

        if (in_array($fileExtension, $tiposImagem)) {
            return 'imagem';
        }

        throw new \InvalidArgumentException("O tipo de arquivo enviado não é válido. Apenas 'video' ou 'imagem' são permitidos.");
    }

    public function publicacoes() {
        return $this->hasMany(Publicacao::class);
    }


}
