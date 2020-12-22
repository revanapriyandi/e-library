<?php

namespace App\Http\Livewire\Anggota;

use App\Models\Anggota;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $query = '';
    public $updatesQueryString = ['page'];

    public function render()
    {
        $datas = Anggota::where('noregistrasi', 'LIKE', "%$this->query%")
            ->orWhere('nama', 'LIKE', "%$this->query%")
            ->orWhere('email', 'LIKE', "%$this->query%")
            ->orderBy('id', 'ASC')
            ->paginate($this->perPage);
        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;
        return view('anggota.index', compact('datas'))
            ->layout('layouts.app', ['header' => 'Anggota Pustaka']);
    }
}
