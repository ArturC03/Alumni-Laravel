<?php


namespace App\Http\Controllers;

use App\Models\Publicacao;
use App\Models\User;
use App\Models\Visibilidade;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
public function index(Request $request)
{
    // Publicações
    $query = Publicacao::query();

    // Filtros opcionais para as publicações
    if ($request->filled('autor')) {
        $query->where('user_id', $request->input('autor'));
    }

    if ($request->filled('visibilidade')) {
        $query->where('visibilidade_id', $request->input('visibilidade'));
    }
    if ($request->filled('visibilidade')) {
        $query->where('visibilidade_id', $request->input('visibilidade'));
    }

    if ($request->filled('data')) {
        $query->whereDate('created_at', $request->input('data'));
    }

    if ($request->filled('ativo')) {
        $query->where('ativo', $request->input('ativo'));
    }

    $publicacoes = $query->latest()->get();

    // Busca usuários sugeridos para seguir (que o usuário autenticado ainda não segue)
    $sugestoes = User::whereNotIn('id', function ($query) {
        $query->select('following_id')
            ->from('followers')
            ->where('follower_id', auth()->id());
    })
        ->where('id', '!=', auth()->id()) // Remove o próprio usuário
        ->inRandomOrder()
        ->take(5) // Limita a 5 sugestões
        ->get();

    return view('welcome', [
        'publicacoes' => $publicacoes,
        'sugestoes' => $sugestoes,
    ]);
    }
}
