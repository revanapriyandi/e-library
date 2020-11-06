<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class ChangeEmail extends Component
{
    public $email;

    public function updateEmail()
    {
        $this->validate([
            'email' => 'required|string|email|unique:users',
        ]);
        $email = $this->email;
        auth()->user()->update([
            'email' => $email
        ]);
        auth()->user()->sendEmailVerificationNotification();

        $this->emit('alert', ['type' => 'success', 'message' => 'Email berhasil diubah']);

        $this->emit('saved');
    }

    public function render()
    {
        return view('profile.change-email');
    }
}
