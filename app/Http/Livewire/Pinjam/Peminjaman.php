<?php

namespace App\Http\Livewire\Pinjam;

use App\Models\Pinjam;
use Livewire\Component;

class Peminjaman extends Component
{
    public $kriteria = 'all';
    public $tglAwal;
    public $tglAkhir;
    public $noAnggota;
    public $periode;
    public  $kode;
    public $judul;
    public $tgl_kembali;
    public $keterangan;
    public $PinjamId;

    public function SqlDatas()
    {
        if ($this->kriteria == 'all') {
            $datas = Pinjam::where('status', 1)->orderBy('tgl_pinjam', 'DESC')->paginate(10);
        } elseif ($this->kriteria == 'tglpinjam') {
            $datas = Pinjam::where('status', 1)
                ->whereBetween('tgl_pinjam', [date('Y-m-d', strtotime($this->tglAwal)), date('Y-m-d', strtotime($this->tglAkhir))])
                ->orderBy('tgl_pinjam', 'DESC')
                ->paginate(10);
        } elseif ($this->kriteria == 'tglkembali') {
            $datas = Pinjam::where('status', 1)
                ->whereBetween('tgl_kembali', [date('Y-m-d', strtotime($this->tglAwal)), date('Y-m-d', strtotime($this->tglAkhir))])
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

    public function perpanjang($id)
    {
        $data = Pinjam::find($id);
        $this->PinjamId = $id;
        $this->kode = $data->daftarPustaka->kodepustaka;
        $this->judul = $data->daftarPustaka->dataPustaka->judul;
        $this->tgl_kembali = $data->tgl_kembali;
        $this->keterangan = $data->keterangan;
    }

    public function resetInputFieldsPerpanjang()
    {
        $this->kode = '';
        $this->judul = '';
        $this->tgl_kembali = '';
        $this->keterangan = '';
    }

    public function perpanjangUpdate()
    {
        $this->validate([
            'tgl_kembali' => 'required|date',
            'keterangan' => 'nullable|string|max:255'
        ]);
        $data = Pinjam::find($this->PinjamId);
        $data->update([
            'tgl_kembali' => $this->tgl_kembali,
            'keterangan' => $this->keterangan
        ]);
        $this->resetInputFieldsPerpanjang();
        $this->emit('alert', ['type' => 'success', 'message' => 'Peminjaman telah diperpanjang']);
        $this->emit('updatedWaktuPeminjaman');
    }

    public function render()
    {
        $datas = $this->SqlDatas();
        return view('pinjam.peminjaman', compact('datas'))
            ->layout('layouts.app', ['header' => 'Peminjaman Pustaka']);
    }
}
