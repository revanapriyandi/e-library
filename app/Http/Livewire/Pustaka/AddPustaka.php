<?php

namespace App\Http\Livewire\Pustaka;

use App\Models\DaftarPustaka;
use App\Models\Format;
use App\Models\Katalog;
use App\Models\Penulis;
use Livewire\Component;
use App\Models\Penerbit;
use App\Models\Pustaka;
use Exception;
use Livewire\WithFileUploads;

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
            'cover' => $this->cover ? 'image|mimes:png,jpeg,jpg' : '',
            'judul' => 'required|string|max:255',
            'katalog' => 'required|integer',
            'penulis' => 'required|integer',
            'penerbit' => 'required|integer',
            'format' => 'required|integer',
            'tahun' => 'required',
            'keyword' => 'required|string|max:255',
            'keteranganfisik' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'harga'  => 'required|integer',
            'abstraksi'  => 'required',
            'keterangan'  => 'nullable|string|max:255',
        ]);
    }

    public function resetInputFields()
    {
        $this->judul = '';
        $this->keteranganfisik = '';
        $this->jumlah = '';
        $this->harga = '';
        $this->keyword = '';
        $this->keterangan = '';
        $this->cover = '';
    }

    public function store()
    {
        $this->validate([
            'cover' => $this->cover ? 'image|mimes:png,jpeg,jpg' : '',
            'judul' => 'required|string|max:255',
            'katalog' => 'required|integer',
            'penulis' => 'required|integer',
            'penerbit' => 'required|integer',
            'format' => 'required|integer',
            'tahun' => 'required',
            'keyword' => 'required|string|max:255',
            'keteranganfisik' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'harga'  => 'required|integer',
            'abstraksi'  => 'required',
            'keterangan'  => 'nullable|string|max:255',
        ]);

        try {
            if ($this->cover) {
                $cover = $this->cover->store('cover-books', 'public');
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
            $datakatalog = Katalog::find($this->katalog);
            $counter = $datakatalog->counter;
            // dd($counter);
            $parm = $this->jumlah;
            if ($parm > 0) {
                for ($i = 1; $i <= $parm; $i++) {
                    $counter++;
                    $kodepustaka = $this->GenKodePustaka($counter);
                    $barcode = $this->GetNewBarcode();
                    DaftarPustaka::create([
                        'pustaka' => $pustaka->id,
                        'kodepustaka' => $kodepustaka,
                        'info1' => $barcode,
                    ]);
                }
            }
            $datakatalog->update(['counter' => $counter]);
            $this->resetInputFields();
            $this->emit('resetInputs');
            $this->emit('alert', ['type' => 'success', 'message' => 'Pustaka Berhasil ditambahkan ']);
        } catch (Exception $e) {
            $this->emit('alert', ['type' => 'danger', 'message' => $e]);
        }
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

    public function GenKodePustaka($counter)
    {
        $ktlg = Katalog::find($this->katalog);
        $pnls = Penulis::find($this->penulis);
        $jdl = substr($this->judul, 0, 1);
        $frmt = Format::find($this->format);
        $cnt = str_pad($counter, 5, '0', STR_PAD_LEFT);

        $unique = true;
        $addcnt = 0;

        do {
            $kode = $ktlg->kode . '/' . $pnls->kode . "/" . $jdl . "/" . $cnt . "/" . $frmt->kode;
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
