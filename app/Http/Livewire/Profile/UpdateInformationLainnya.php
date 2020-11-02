<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class UpdateInformationLainnya extends Component
{
    public function render()
    {
        return view('profile.update-information-lainnya')
            ->layout('layouts.app', ['header' => 'Update Lainnya']);
    }
}
