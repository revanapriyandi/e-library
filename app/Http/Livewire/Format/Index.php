<?php

namespace App\Http\Livewire\Format;

use App\Models\Format;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $no = 1, $data, $kode, $nama, $keterangan;
    public $perPage = 10;
    public $query = '';
    public $updatesQueryString = ['page'];
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->kode = '';
        $this->nama = '';
        $this->keterangan = '';
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'kode'   => 'required|max:3|unique:format,kode,' . $this->kode,
            'nama' => 'required|max:100|string',
            'keterangan' => 'nullable|string|max:255',
        ]);
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'kode'   => 'required|max:3|unique:format,kode,' . $this->kode,
            'nama' => 'required|max:100|string',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Format::create($validatedDate);

        $this->resetInputFields();

        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil ditambahkan !']);

        $this->emit('formatStore');
    }

    public function edit($id)
    {
        $this->data = Format::findOrFail($id);
        if ($this->data) {
            $this->updateMode = true;
            $this->kode   = $this->data->kode;
            $this->nama    = $this->data->nama;
            $this->keterangan  = $this->data->keterangan;
        }
    }

    public function update()
    {
        $this->validate([
            'kode'   => 'required|max:3',
            'nama' => 'required|max:100|string',
            'keterangan' => 'nullable|string|max:255',

        ]);
        $this->data->update([
            'kode' => $this->kode,
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
        ]);
        $this->updateMode = false;

        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil diupdate !']);
        $this->emit('updatedFormat');
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function destroy($id)
    {
        Format::find($id)->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil dihapus !']);
    }

    public function render()
    {
        $datas = Format::where('nama', 'LIKE', "%$this->query%")
            ->orWhere('kode', 'LIKE', "%$this->query%")
            ->orWhere('keterangan', 'LIKE', "%$this->query%")
            ->orderBy('id', 'ASC')
            ->paginate($this->perPage);
        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;
        return view('format.index', compact('datas'))
            ->layout('layouts.app', ['header' => 'Format Pustaka']);
    }
}
