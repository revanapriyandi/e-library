<?php

namespace App\Http\Livewire\Profile;

use Carbon\Carbon;
use Livewire\Component;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Validation\ValidationException;

class UpdateInformationLainnya extends Component
{
    public $confirmingLogout = false;

    public function render()
    {
        return view('profile.update-information-lainnya')
            ->layout('layouts.app', ['header' => 'Update Lainnya']);
    }
}
