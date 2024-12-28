<?php

/** @noinspection ALL */

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $table = 'users';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = [
        'name',
        'nickname',
        'email',
        'password',
        'cargo_id',
        'visibilidade_id',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function follow(User $user)
    {
        // Verifica se o usuário está autenticado
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar autenticado para seguir alguém.');
        }

        // Obtem o usuário autenticado
        $authenticatedUser = auth()->user();

        // Confere se o usuário já está seguindo
        if ($authenticatedUser && !$authenticatedUser->following()->where('following_id', $user->id)->exists()) {
            $authenticatedUser->following()->attach($user->id); // Conecta o usuário na relação de seguidores
        }

        return back()->with('success', 'Você começou a seguir ' . $user->name);
    }

    public function unfollow(User $user)
    {
        // Verifica se o usuário está autenticado
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar autenticado para parar de seguir alguém.');
        }

        // Obtem o usuário autenticado
        $authenticatedUser = auth()->user();

        // Remove a relação de seguir apenas se o usuário realmente estiver conectado
        if ($authenticatedUser) {
            $authenticatedUser->following()->detach($user->id);
        }

        return back()->with('success', 'Você deixou de seguir ' . $user->name);
    }

    public function isFollowing(User $user)
    {
        return $this->following()
            ->where('following_id', $user->id)
            ->exists();
    }

    public function isFollowedBy(User $user)
    {
        return $this->followers()
            ->where('follower_id', $user->id)
            ->exists();
    }

    public function isAdmin(): bool
    {
        return this->cargo->nome === 'Administrador';
    }

    public function Reagiu($publicacao_id): bool
    {
        if($this->reacoes()->where('publicacao_id', $publicacao_id)->exists()) {
            $likeState = $this->reacoes()->where('publicacao_id', $publicacao_id)->first()->like;
        } else {
            $likeState = false;
        }
        // Verifica se o usuário já reagiu à publicação (pode ajustar para ser também para comentários se necessário)
        return $likeState;
    }


    public function cargo()
    {
        return $this->hasMany(Cargo::class);
    }

    public function publicacoes()
    {
        return $this->hasMany(Publicacao::class);
    }

    public function visibilidade() {
        return $this->hasMany(visibilidade::class);
    }

    public function reacoes() {
        return $this->hasMany(Reacao::class);
    }

    public function comentarios() {
        return $this->hasMany(Comentario::class);
    }

    // Usuários que este usuário está seguindo
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,          // Relaciona com o modelo User
            'followers',          // Nome da tabela pivot
            'follower_id',        // Coluna pivot que representa quem segue
            'following_id'        // Coluna pivot que representa quem está sendo seguido
        )->withTimestamps();
    }

    // Usuários que estão seguindo este usuário
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,          // Relaciona com o modelo User
            'followers',          // Nome da tabela pivot
            'following_id',       // Coluna pivot que representa quem está sendo seguido
            'follower_id'         // Coluna pivot que representa quem segue
        )->withTimestamps();
    }

}
