<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\PublicacaoController;
use Illuminate\Support\Facades\Route;
use App\Models\Publicacao;
use App\Models\User;
use \App\Http\Controllers\WelcomeController;
use \App\Http\Controllers\FollowerController;
use App\Http\Controllers\UserProfileController;

Route::get(
    '/',
    [WelcomeController::class, 'index']
)->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get(
        '/publicacao/criar',
        [PublicacaoController::class, 'criar']
    )->name('publicacao.criar');

    Route::post(
        '/publicacao',
        [PublicacaoController::class, 'guardar']
    )->name('publicacao.guardar');
});

Route::get('/set-theme/{theme}', function ($theme) {
    session(['theme' => $theme]);
    return response()->json(['status' => 'success']);
});

Route::bind('user', function ($id) {
    return User::findOrFail($id);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/follow/{user}', [FollowerController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{user}', [FollowerController::class, 'unfollow'])->name('unfollow');
});

Route::post('/comentarios/{publicacao}', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::get('/perfil/{identifier}', [UserProfileController::class, 'show'])
    ->name('perfil.show');
