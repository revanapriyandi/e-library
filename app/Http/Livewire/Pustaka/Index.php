<?php

namespace App\Http\Livewire\Pustaka;

use App\Models\Pustaka;
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

    public function destroy($PustakaId)
    {
        Pustaka::find($PustakaId)->delete();

        $this->emit('alert', ['type' => 'success', 'message' => 'Order deleted successfully! ']);
    }

    public function render()
    {
        $datas = Pustaka::with(['daftarPustaka', 'katalogs'])
            ->where('katalog', 'LIKE', "%$this->query%")
            ->orWhere('judul', 'LIKE', "%$this->query%")
            ->orderBy('id', 'ASC')
            ->paginate($this->perPage);
        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;
        return view('pustaka.index', compact('datas'))
            ->layout('layouts.app', ['header' => 'Daftar Pustaka']);
    }
}
