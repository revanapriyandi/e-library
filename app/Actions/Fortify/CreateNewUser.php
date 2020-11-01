<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'noregistrasi' => $this->registrationNumber(),
            'nama' => $input['nama'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
    private function registrationNumber()
    {
        $user = new User;
        $num = $user->orderBy('created_at', 'desc')->count();
        $dataCode = $user->orderBy('created_at', 'desc')->first();
        if ($num == 0) {
            $code = date('dmy') . '0001';
        } else {
            $c = $dataCode->noregistrasi;
            $code = substr($c, 6) + 1;
            $code = date('dmy') . $code;
        }
        return $code;
    }
}
