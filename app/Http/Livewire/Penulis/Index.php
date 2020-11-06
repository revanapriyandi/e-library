<?php

namespace App\Http\Livewire\Penulis;

use App\Models\Penulis;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $no = 1, $penulisId, $kode, $nama, $gelar_depan, $gelar_belakang, $kontak, $biografi, $keterangan;
    public $perPage = 10;
    public $query = '';
    public $updatesQueryString = ['page'];
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->kode = '';
        $this->gelar_depan = '';
        $this->nama = '';
        $this->gelar_belakang = '';
        $this->kontak = '';
        $this->biografi = '';
        $this->keterangan = '';
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'kode' => 'required|max:3|string|unique:penulis,kode,' . $this->kode,
            'nama' => 'required|string|max:100',
            'gelar_depan' => 'nullable|max:45|string',
            'gelar_belakang' => 'nullable|max:45|string',
            'kontak' => 'nullable|max:255',
            'biografi' => 'nullable',
            'keterangan' => 'nullable|string|max:255',
        ]);
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'kode' => 'required|max:3|string|unique:penulis,kode,' . $this->kode,
            'nama' => 'required|string|max:100',
            'gelar_depan' => 'nullable|max:45|string',
            'gelar_belakang' => 'nullable|max:45|string',
            'kontak' => 'nullable|max:255',
            'biografi' => 'nullable',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Penulis::create($validatedDate);

        $this->resetInputFields();

        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil ditambahkan !']);

        $this->emit('penulisStore');
    }

    public function edit($id)
    {
        $data = Penulis::find($id);
        $this->updateMode = true;
        $this->penulisId = $id;
        $this->kode = $data->kode;
        $this->gelar_depan = $data->gelar_depan;
        $this->nama = $data->nama;
        $this->gelar_belakang = $data->gelar_belakang;
        $this->kontak = $data->kontak;
        $this->biografi = $data->biografi;
        $this->keterangan = $data->keterangan;
    }

    public function update()
    {
        $this->validate([
            'kode' => 'required|max:3|string',
            'nama' => 'required|string|max:100',
            'gelar_depan' => 'nullable|max:45|string',
            'gelar_belakang' => 'nullable|max:45|string',
            'kontak' => 'nullable|max:255',
            'biografi' => 'nullable',
            'keterangan' => 'nullable|string|max:255',
        ]);

        if ($this->penulisId) {
            $data = Penulis::find($this->penulisId);
            $data->update([
                'kode' => $this->kode,
                'gelar_depan' => $this->gelar_depan,
                'nama' => $this->nama,
                'gelar_belakang' => $this->gelar_belakang,
                'kontak' => $this->kontak,
                'biografi' => $this->biografi,
                'keterangan' => $this->keterangan,
            ]);
            $this->updateMode = false;
            $this->resetInputFields();
            $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil diupdated !']);
            $this->emit('updatedPenulis');
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function destroy($id)
    {
        Penulis::find($id)->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil dihapus !']);
    }

    public function render()
    {
        $datas = Penulis::where('kode', 'LIKE', "%$this->query%")
            ->orWhere('nama', 'LIKE', "%$this->query%")
            ->orWhere('biografi', 'LIKE', "%$this->query%")
            ->orWhere('kontak', 'LIKE', "%$this->query%")
            ->orWhere('keterangan', 'LIKE', "%$this->query%")
            ->orderBy('id', 'ASC')
            ->paginate($this->perPage);
        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;
        return view('penulis.index', compact('datas'))
            ->layout('layouts.app', ['header' => 'Daftar Penulis']);
    }
}
