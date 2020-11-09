<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class Show extends Component
{
    public function render()
    {
        return view('profile.show')
            ->layout('layouts.app', ['header' => 'Profile']);
    }
}
