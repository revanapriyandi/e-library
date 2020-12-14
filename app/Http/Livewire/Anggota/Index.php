<?php

namespace App\Http\Livewire\Anggota;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('anggota.index')
            ->layout('layouts.app', ['header' => 'Anggota Pustaka']);
    }
}
