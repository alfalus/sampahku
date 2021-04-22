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
            'no_hp' => ['required', 'numeric', 'digits_between:10,13'],
            'alamat' => ['required', 'string', 'max:255'],
            'provinsi' => ['nullable', 'alphanum', 'max:64'],
            'kota' => ['required', 'alphanum', 'max:64'],
            'kecamatan' => ['required', 'alphanum', 'max:64'],
            'kelurahan' => ['required', 'alphanum', 'max:64'],
            'role' => ['required', 'string', 'max:1'],
            'password' => $this->passwordRules(),
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'no_hp' => $input['no_hp'],
            'alamat' => $input['alamat'],
            'provinsi' => isset($input['provinsi']) ? $input['provinsi'] : env('AREA_ALLOW'),
            'kota' => $input['kota'],
            'kecamatan' => $input['kecamatan'],
            'kelurahan' => $input['kelurahan'],
            'role' => $input['role'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
