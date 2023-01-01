<?php

namespace App\Actions\Fortify;

use App\Models\User;
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
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nik' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'divisi' => ['required', 'string', 'max:255'],
            'card' => ['required', 'string', 'max:255'],
            'no_telp' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'agama' => ['required', 'string', 'max:255'],
            'jk' => ['required', 'string', 'max:255'],
            'lahir' => ['required', 'string', 'max:255'],
            'masuk' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'username' => $input['username'],
            'nik' => $input['nik'],
            'divisi' => $input['divisi'],
            'card' => $input['card'],
            'no_telp' => $input['no_telp'],
            'alamat' => $input['alamat'],
            'agama' => $input['agama'],
            'jk' => $input['jk'],
            'lahir' => $input['lahir'],
            'masuk' => $input['masuk'],
            'role' => 'pengguna',
            'password' => Hash::make($input['password']),
        ]);
    }
}
