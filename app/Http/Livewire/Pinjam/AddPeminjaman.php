<?php

namespace App\Http\Livewire\Pinjam;

use Livewire\Component;

class AddPeminjaman extends Component
{
    public function render()
    {
        return view('pinjam.add-peminjaman')
            ->layout('layouts.app', ['header' => 'Peminjaman Pustaka Baru']);
    }
}
