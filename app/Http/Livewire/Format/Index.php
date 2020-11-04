<?php

namespace App\Http\Livewire\Format;

use App\Models\Format;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Index extends Component
{
    public $data, $no = 1, $kode, $nama, $keterangan, $formatId;
    public $updateMode = false;
    public $modal = '';

    private function resetInputFields()
    {
        $this->kode = '';
        $this->nama = '';
        $this->keterangan = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'kode' => 'required|max:3|unique:format,kode',
            'nama' => 'required|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Format::create($validatedDate);

        $this->resetInputFields();
        $this->updateMode = false;
        Session::flash('message', "Data berhasil disimpan !");
        Session::flash('message_type', 'success');
        $this->emit('formatStore');
    }


    public function delete($id)
    {
        if ($id) {
            Format::where('id', $id)->delete();
            session()->flash('message', 'Format Deleted Successfully.');
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $format = Format::where('id', $id)->first();
        $this->format_id = $id;
        $this->kode = $format->kode;
        $this->nama = $format->nama;
        $this->keterangan = $format->keterangan;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'kode' => 'required|max:3',
            'nama' => 'required|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        if ($this->formatId) {
            $format = Format::find($this->formatId);
            $format->update([
                'kode' => $this->kode,
                'nama' => $this->nama,
                'keterangan' => $this->keterangan,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Format Updated Successfully.');
            $this->resetInputFields();
        }
    }
    public function render()
    {
        $this->data = Format::orderBy('created_at', 'DESC')->get();
        return view('format.index')
            ->layout('layouts.app', ['header' => 'Daftar Format Pustaka']);
    }
}
