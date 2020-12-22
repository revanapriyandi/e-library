<?php

namespace App\Http\Livewire\Anggota;

use Livewire\Component;

class FormAnggota extends Component
{
    public $photo;
    public $job;
    public $tipe;

    public function mount($job = null)
    {
        $this->job = $job;
    }

    public function tipeJob($tipe)
    {
        return redirect(route('anggota.form', $tipe));
    }

    public function cancel()
    {
        return redirect(route('anggota.index'));
    }

    public function submitData()
    {
        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil ditambahkan !']);
    }

    public function render()
    {
        return view('anggota.form-anggota')
            ->layout('layouts.app', ['header' => 'Form Anggota Pustaka']);
    }
}
