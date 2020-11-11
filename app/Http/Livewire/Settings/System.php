<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

class System extends Component
{
    public function render()
    {
        return view('settings.system')
            ->layout('layouts.app', ['header' => 'System Settings']);
    }
}
