<?php

namespace App\Actions\Fortify;

use App\Models\Cargo;
use App\Models\User;
use App\Models\Visibilidade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     *
     * @noinspection UnknownColumnInspection
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        if (isset($input['cargo_id'])) {
            $cargoId = $input['cargo_id'];

        } elseif (isset($input['nome_cargo'])) {
            $cargoId = Cargo::where('nome', strtolower($input['nome_cargo'] ?? 'utilizador'))->value('id');
        } else {
            $cargoId = Cargo::where('nome', 'utilizador')->first()->id;
        }

        if (isset($input['nome_visibilidade'])) {
            $visibilidadeId = Visibilidade::where('estado', strtolower($input['nome_visibilidade']))->value('id');
        } else {
            $visibilidadeId = Visibilidade::where('estado', 'Público')->value('id') ?? Visibilidade::where('nome', 'Público')->first()->id;
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'cargo_id' => $cargoId,
            'visibilidade_id' => $visibilidadeId,
        ]);
    }
}
