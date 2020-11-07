<?php

namespace App\Http\Livewire\Penerbit;

use Livewire\Component;
use App\Models\Penerbit;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $no = 1, $penerbitId, $kode, $nama, $alamat, $telpon, $email, $fax, $website, $kontak, $keterangan;
    public $perPage = 10;
    public $query = '';
    public $updatesQueryString = ['page'];
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->kode = '';
        $this->nama = '';
        $this->alamat = '';
        $this->telpon = '';
        $this->email = '';
        $this->fax = '';
        $this->website = '';
        $this->kontak = '';
        $this->keterangan = '';
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'kode' => 'required|max:3|string|unique:katalog,kode,' . $this->kode,
            'nama' => 'required|string|max:100',
            'alamat' => 'nullable|max:255|string',
            'telpon' => 'nullable|max:100|string',
            'email' => 'nullable|email|string|max:100',
            'fax' => 'nullable|string|max:100',
            'website' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'kode' => 'required|max:3|string|unique:katalog,kode,' . $this->kode,
            'nama' => 'required|string|max:100',
            'alamat' => 'nullable|max:255|string',
            'telpon' => 'nullable|max:100|string',
            'email' => 'nullable|email|string|max:100',
            'fax' => 'nullable|string|max:100',
            'website' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Penerbit::create($validatedDate);

        $this->resetInputFields();

        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil ditambahkan !']);

        $this->emit('penerbitStore');
    }

    public function edit($id)
    {
        $data = Penerbit::find($id);
        $this->updateMode = true;
        $this->penerbitId = $id;
        $this->kode = $data->kode;
        $this->nama = $data->nama;
        $this->alamat = $data->alamat;
        $this->telpon = $data->telpon;
        $this->email = $data->email;
        $this->fax = $data->fax;
        $this->website = $data->website;
        $this->kontak = $data->kontak;
        $this->keterangan = $data->keterangan;
    }

    public function update()
    {
        $this->validate([
            'kode' => 'required|max:3|string|unique:katalog,kode,' . $this->kode,
            'nama' => 'required|string|max:100',
            'alamat' => 'nullable|max:255|string',
            'telpon' => 'nullable|max:100|string',
            'email' => 'nullable|email|string|max:100',
            'fax' => 'nullable|string|max:100',
            'website' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        if ($this->penerbitId) {
            $data = Penerbit::find($this->penerbitId);
            $data->update([
                'kode' => $this->kode,
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'telpon' => $this->telpon,
                'email' => $this->email,
                'fax' => $this->fax,
                'website' => $this->website,
                'kontak' => $this->kontak,
                'keterangan' => $this->keterangan,
            ]);
            $this->updateMode = false;
            $this->resetInputFields();
            $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil diupdated !']);
            $this->emit('updatedPenerbit');
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function destroy($id)
    {
        Penerbit::find($id)->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil dihapus !']);
    }

    public function render()
    {
        $datas = Penerbit::where('kode', 'LIKE', "%$this->query%")
            ->orWhere('nama', 'LIKE', "%$this->query%")
            ->orWhere('keterangan', 'LIKE', "%$this->query%")
            ->orderBy('id', 'ASC')
            ->paginate($this->perPage);
        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;
        return view('penerbit.index', compact('datas'))
            ->layout('layouts.app', ['header' => 'Daftar Penerbit']);
    }
}
