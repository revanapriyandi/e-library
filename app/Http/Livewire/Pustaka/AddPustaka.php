<?php

namespace App\Http\Livewire\Pustaka;

use App\Models\DaftarPustaka;
use App\Models\Format;
use App\Models\Katalog;
use App\Models\Penulis;
use Livewire\Component;
use App\Models\Penerbit;
use App\Models\Pustaka;
use Illuminate\Support\Facades\App;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AddPustaka extends Component
{
    use WithFileUploads;
    public $judul;
    public $katalog;
    public $penulis;
    public $penerbit;
    public $format;
    public $tahun;
    public $keteranganfisik;
    public $jumlah;
    public $harga;
    public $abstraksi;
    public $keyword;
    public $keterangan;

    public $cover;

    public function updated($field)
    {
        $this->validateOnly($field, [
            'cover' => $this->cover ? 'image|mimes:jpeg,jpg' : '',
            'judul' => 'required|string|max:255',
            'katalog' => 'required|integer|max:20',
            'penulis' => 'required|integer|max:20',
            'penerbit' => 'required|integer|max:20',
            'format' => 'required|integer|max:20',
            'tahun' => 'required',
            'keyword' => 'required|string|max:255',
            'keteranganfisik' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'harga'  => 'required|max:20',
            'abstraksi'  => 'required',
            'keterangan'  => 'nullable|string|max:255',

        ]);
    }

    public function store()
    {
        if ($this->cover) {
            $cover = $this->cover->store('cover-books');
        } else {
            $cover =  null;
        }
        $pustaka = Pustaka::create([
            'cover' => $cover,
            'judul' => $this->judul,
            'katalog' => $this->katalog,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'format' => $this->format,
            'tahun' => $this->tahun,
            'keyword' => $this->keyword,
            'keteranganfisik' => $this->keteranganfisik,
            'harga'  => $this->UnformatRupiah(trim(addslashes($this->harga))),
            'abstraksi'  => $this->abstraksi,
            'keterangan'  => $this->keterangan,
        ]);
        if (!$pustaka) {
            App::abort(500, 'Some Error');
        }
        $ktg = Katalog::find($this->katalog)->select('counter');
        $counter = $ktg;
        $parm = $this->jumlah;
        if ($parm > 0) {
            for ($j = 1; $j <= $parm; $j++) {
                $counter++;
                $kodepustaka = $this->GenKodePustaka($this->katalog, $this->penulis, $this->judul, $this->format, $counter);
                $barcode = $this->GetNewBarcode();
                $dftr_pustaka = DaftarPustaka::create([
                    'pustaka' => $pustaka->id,
                    'kodepustaka' => $kodepustaka,
                    'info1' => $barcode,
                ]);
            }
        }
        if ($dftr_pustaka) {
            Katalog::update([
                'counter' => $counter
            ]);
        }
        $this->emit('alert', ['type' => 'success', 'message' => 'Pustaka Berhasil ditambahkan ']);
    }

    public function GenerateBarcode($length = 7)
    {
        $dict = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $barcode = "";
        for ($i = 0; $i < $length; $i++) {
            $pos = rand(0, strlen($dict) - 1);
            $barcode .= substr($dict, $pos, 1);
        }

        return $barcode;
    }

    public function UnformatRupiah($value)
    {
        $pos = strpos($value, "(");

        $negatif = true;
        if ($pos === false) {
            $negatif = false;
        }

        $value = str_replace("Rp", "", $value);
        $value = str_replace(".", "", $value);
        $value = str_replace(" ", "", $value);
        $value = str_replace("(", "", $value);
        $value = str_replace(")", "", $value);


        if ($negatif) {
            $num = "-" . $value;
        } else {
            $num = $value;
        }
        return (int)$num;
    }

    public function GetNewBarcode()
    {
        $barcode = "";
        do {
            $barcode = $this->GenerateBarcode(7);
            $row = DaftarPustaka::select('id')->where('info1', '$barcode')->count();
            $ndata = (int)$row;
        } while ($ndata != 0);
        return $barcode;
    }

    public function GenKodePustaka($katalog, $penulis, $judul, $format, $counter)
    {
        $ktlg = Katalog::find($katalog)->select('kode');
        $pnls = Penulis::find($penulis)->select('kode');
        $jdl = substr($judul, 0, 1);
        $frmt = Format::find($format)->select('kode');
        $cnt = str_pad('Panu', 5, '0', STR_PAD_LEFT);

        $unique = true;
        $addcnt = 0;

        do {
            // $kode = $ktlg . "/" . $pnls . "/" . $jdl . "/" . $cnt . "/" . $frmt;
            $kode = "11111/BMS/K/00001/BU";
            $cek = DaftarPustaka::select('id')->where('kodepustaka', $kode)->count();

            if ($cek > 0) {
                $addcnt++;
                $cnt = "$cnt.$addcnt";
                $unique = false;
            } else {
                $unique = true;
            }
        } while (!$unique);
        return $kode;
    }

    public function render()
    {
        return view('pustaka.add-pustaka', [
            'katalogs' => Katalog::all(),
            'penuliss' => Penulis::all(),
            'penerbits' => Penerbit::all(),
            'formats' => Format::all(),
        ])
            ->layout('layouts.app', ['header' => 'Pustaka Baru']);
    }
}
