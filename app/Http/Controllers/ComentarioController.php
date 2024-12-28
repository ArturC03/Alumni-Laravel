<?php

namespace App\Http\Controllers;

use App\Models\Publicacao;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function store(Request $request, $publicacaoId)
    {
        $request->validate([
            'conteudo' => 'required|string|max:500',
        ]);

        $publicacao = Publicacao::findOrFail($publicacaoId);

        $publicacao->comentarios()->create([
            'conteudo' => $request->conteudo,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Comentário adicionado com sucesso!');
    }
}
