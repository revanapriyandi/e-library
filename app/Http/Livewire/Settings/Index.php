<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('settings.index')
            ->layout('layouts.app', ['header' => 'Pengaturan']);
    }
}
