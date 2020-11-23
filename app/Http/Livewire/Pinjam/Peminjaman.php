<?php

namespace App\Http\Livewire\Pinjam;

use App\Models\Pinjam;
use Livewire\Component;

class Peminjaman extends Component
{
    public $kriteria = 'all';
    public $noAnggota;
    public $periode = '';

    public function updatedKriteria($value)
    {
        $this->kriteria = $value;
    }

    public function updatedPeriode($value)
    {
        $this->periode = $value;
    }

    public function SqlDatas()
    {
        if ($this->kriteria == 'all') {
            $datas = Pinjam::where('status', 1)->orderBy('tgl_pinjam', 'DESC')->paginate(10);
        } elseif ($this->kriteria == 'tglpinjam') {
            $datas = Pinjam::where('status', 1)
                ->whereBetween('tgl_pinjam', date('Y-m-d', strtotime($this->periode)))
                ->orderBy('tgl_pinjam', 'DESC')
                ->paginate(10);
        } elseif ($this->kriteria == 'tglkembali') {
            $datas = Pinjam::where('status', 1)
                ->whereBetween('tgl_kembali', date('Y-m-d', strtotime($this->periode)))
                ->orderBy('tgl_pinjam', 'DESC')
                ->paginate(10);
        } else {
            $datas = Pinjam::where('status', 1)
                ->where('nis', $this->noAnggota)
                ->orWhere('nip', $this->noAnggota)
                ->orderBy('tgl_pinjam', 'DESC')
                ->paginate(10);
        }
        return $datas;
    }

    public function render()
    {
        dump($this->kriteria);
        $datas = $this->SqlDatas();
        return view('pinjam.peminjaman', compact('datas'))
            ->layout('layouts.app', ['header' => 'Peminjaman Pustaka']);
    }
}
