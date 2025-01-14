<?php

namespace App\Http\Controllers;

use App\Models\Publicacao;
use App\Models\User;

class UserProfileController extends Controller
{
    /**
     * Mostra o perfil do utilizador.
     *
     * @param  string  $identifier  - ID ou nickname do usuário
     * @return \Illuminate\View\View
     */
    public function show($identifier)
    {
        // Buscar o utilizador pelo ID ou nickname
        $user = User::query()
            ->where('id', $identifier)
            ->orWhere('nickname', $identifier)
            ->firstOrFail();

        // Encontrar as publicações do utilizador (ordem mais recente primeiro)
        $publicacoes = Publicacao::query()
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $publicacoes_total = $publicacoes
            ->where('user_id', $user->id)
            ->count();

        // Retornar a view com o utilizador e as publicações
        return view('users.profile', [
            'user' => $user,
            'publicacoes' => $publicacoes,
            'publicacoes_total' => $publicacoes_total,
        ]);
    }

public function index()
{
    $users = User::All();

    return view('users.index', [
        'users' => $users,
    ]);
}

}
