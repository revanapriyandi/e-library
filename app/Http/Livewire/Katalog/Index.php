<?php

namespace App\Http\Livewire\Katalog;

use App\Models\Katalog;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $no = 1, $katalogId, $nama, $kode, $rak, $keterangan;
    public $perPage = 10;
    public $query = '';
    public $updatesQueryString = ['page'];
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->kode = '';
        $this->nama = '';
        $this->rak = '';
        $this->keterangan = '';
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'kode' => 'required|max:15|string|unique:katalog,kode,' . $this->kode,
            'nama' => 'required|string|max:100',
            'rak' => 'required',
            'keterangan' => 'nullable|string|max:255',
        ]);
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'kode' => 'required|max:15|string',
            'nama' => 'required|string|max:100',
            'rak' => 'required',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Katalog::create($validatedDate);

        $this->resetInputFields();

        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil ditambahkan !']);

        $this->emit('katalogStore');
    }

    public function edit($id)
    {
        $katalog = Katalog::find($id);
        $this->updateMode = true;
        $this->katalogId = $id;
        $this->kode = $katalog->kode;
        $this->rak = $katalog->rak;
        $this->nama = $katalog->nama;
        $this->keterangan = $katalog->keterangan;
    }

    public function update()
    {
        $this->validate([
            'kode' => 'required|max:15|string',
            'nama' => 'required|string|max:100',
            'rak' => 'required',
            'keterangan' => 'nullable|string|max:255',
        ]);

        if ($this->katalogId) {
            $katalog = Katalog::find($this->katalogId);
            $katalog->update([
                'kode' => $this->kode,
                'rak' => $this->rak,
                'nama' => $this->nama,
                'keterangan' => $this->keterangan,
            ]);
            $this->updateMode = false;
            $this->resetInputFields();
            $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil diupdated !']);
            $this->emit('updatedKatalog');
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function destroy($id)
    {
        Katalog::find($id)->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil dihapus !']);
    }

    public function render()
    {
        $datas = Katalog::where('kode', 'LIKE', "%$this->query%")
            ->orWhere('nama', 'LIKE', "%$this->query%")
            ->orWhere('keterangan', 'LIKE', "%$this->query%")
            ->orderBy('id', 'ASC')
            ->paginate($this->perPage);
        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;
        return view('katalog.index', compact('datas'))
            ->layout('layouts.app', ['header' => 'Daftar Katalog Pustaka']);
    }
}
