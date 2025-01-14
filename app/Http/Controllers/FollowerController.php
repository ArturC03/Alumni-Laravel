<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function follow(User $user)
    {
        // Obtem o usuário autenticado
        $authenticatedUser = Auth::user();

        // Verifica se o usuário já está seguindo
        if ($authenticatedUser && ! $authenticatedUser->following()->where('following_id', $user->id)->exists()) {
            $authenticatedUser->following()->attach($user->id); // Conecta na tabela 'followers'
        }

        return back()->with('success', 'Você começou a seguir '.$user->name);
    }

    public function unfollow(User $user)
    {
        $authenticatedUser = Auth::user();

        // Verifica se o usuário está seguindo
        if ($authenticatedUser && $authenticatedUser->following()->where('following_id', $user->id)->exists()) {
            $authenticatedUser->following()->detach($user->id); // Remove da tabela 'followers'
        }

        return back()->with('success', 'Você deixou de seguir ' . $user->name);
    }
}
