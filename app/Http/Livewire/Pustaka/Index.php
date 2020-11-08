<?php

namespace App\Http\Livewire\Pustaka;

use App\Models\Pustaka;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('pustaka.index', [
            'datas' => Pustaka::with(['daftarPustaka', 'katalog'])->orderBy('created_at', 'ASC')->paginate(10),
        ])
            ->layout('layouts.app', ['header' => 'Daftar Pustaka']);
    }
}
