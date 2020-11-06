<?php

namespace App\Http\Livewire\Rak;

use App\Models\Rak;
use App\Models\Katalog;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $no = 1, $rakId, $rak, $keterangan;
    public $perPage = 10;
    public $query = '';
    public $updatesQueryString = ['page'];
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->rak = '';
        $this->keterangan = '';
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'rak' => 'required|string|max:25',
            'keterangan' => 'required|string|max:255',
        ]);
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'rak' => 'required|max:25|string',
            'keterangan' => 'required|string|max:255',
        ]);

        Rak::create($validatedDate);

        $this->resetInputFields();

        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil ditambahkan !']);

        $this->emit('rakStore');
    }

    public function edit($id)
    {
        $rak = Rak::find($id);
        $this->updateMode = true;
        $this->rakId = $id;
        $this->rak = $rak->rak;
        $this->keterangan = $rak->keterangan;
    }

    public function update()
    {
        $this->validate([
            'rak' => 'required|max:25|string',
            'keterangan' => 'required|string|max:255',
        ]);

        if ($this->rakId) {
            $rak = Rak::find($this->rakId);
            $rak->update([
                'rak' => $this->rak,
                'keterangan' => $this->keterangan,
            ]);
            $this->updateMode = false;
            $this->resetInputFields();
            $this->emit('updatedRak');
            $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil diupdated !']);
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function destroy($id)
    {
        Rak::find($id)->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil dihapus !']);
    }

    public function render()
    {
        $datas = Rak::where('rak', 'LIKE', "%$this->query%")
            ->orWhere('keterangan', 'LIKE', "%$this->query%")
            ->orderBy('id', 'ASC')
            ->paginate($this->perPage);
        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;
        return view('rak.index', compact('datas'))
            ->layout('layouts.app', ['header' => 'Daftar Rak Pustaka']);
    }
}
