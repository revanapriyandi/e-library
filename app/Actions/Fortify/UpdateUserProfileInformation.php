<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'telpon' => ['required', 'max:20'],
            'alamat' => ['required'],
            'address' => ['required'],
            'kecamatan' => ['required'],
            'kabupaten' => ['required'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }
        if ($input['alamat']) {
            $alamat = $input['alamat'];
        } else {
            $alamat = $input['address'] . ', Desa ' . $input['village'] . ', RT/TW ' . $input['rtrw'] . ', ' . $input['kecamatan'] . ', ' . $input['kabupaten'];
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'nama' => $input['nama'],
                'email' => $input['email'],
                'pekerjaan' => $input['pekerjaan'],
                'telpon' => $input['telpon'],
                'alamat' => $alamat,
                'kodepos' => $input['kodepos'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'nama' => $input['nama'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
