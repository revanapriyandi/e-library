<?php

namespace App\Http\Livewire\Pustaka;

use Exception;
use App\Models\Format;
use App\Models\Katalog;
use App\Models\Penulis;
use App\Models\Pustaka;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DaftarPustaka;

class Adddel extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $query = '';
    public $updatesQueryString = ['page'];

    public $pustaka;
    public $jumlah;

    public function mount($id)
    {
        $this->pustaka = Pustaka::find($id);
    }

    public function resetInputFields()
    {
        $this->jumlah = '';
    }

    public function store()
    {
        $this->validate(['jumlah' => 'required|integer']);

        $data = DaftarPustaka::where('pustaka', $this->pustaka->id)->first();
        $datakatalog = Katalog::find($data->dataPustaka->katalog);
        $counter = $datakatalog->counter;
        // dd($data->dataPustaka->katalog);
        $parm = $this->jumlah;
        if ($parm > 0) {
            for ($i = 1; $i <= $parm; $i++) {
                $counter++;
                $kodepustaka = $this->GenKodePustaka($counter);
                $barcode = $this->GetNewBarcode();
                DaftarPustaka::create([
                    'pustaka' => $this->pustaka->id,
                    'kodepustaka' => $kodepustaka,
                    'info1' => $barcode,
                ]);
            }
        }
        $datakatalog->update(['counter' => $counter]);
        $this->resetInputFields();
        $this->emit('pustakaStore');
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
        $ktlg = Katalog::find($this->pustaka->katalog);
        $pnls = Penulis::find($this->pustaka->penulis);
        $jdl = substr($this->pustaka->judul, 0, 1);
        $frmt = Format::find($this->pustaka->format);
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


    public function Active($daftarPustakaId)
    {
        $data = DaftarPustaka::find($daftarPustakaId);
        if ($data->status == 0) {
            $this->emit('alert', ['type' => 'warning', 'message' => 'Tidak bisa mengubah pustaka ini karena telah dipinjam sebelumnya']);
        }
        if ($data->aktif == 1) {
            $newaktif = 0;
        } else {
            $newaktif = 1;
        }
        $data->update(['aktif' => $newaktif]);
        $this->emit('alert', ['type' => 'success', 'message' => 'Berhasil merubah status aktif pustaka']);
    }

    public function destroy($daftarPustakaId)
    {
        DaftarPustaka::find($daftarPustakaId)->delete();

        $this->emit('alert', ['type' => 'success', 'message' => 'Order deleted successfully! ']);
    }

    public function render()
    {
        $datas = DaftarPustaka::with(['dataPustaka'])->where('pustaka', $this->pustaka->id)
            ->where('kodepustaka', 'LIKE', "%$this->query%")
            ->paginate($this->perPage);
        $this->page > $datas->lastPage() ? $this->page = $datas->lastPage() : true;
        return view('pustaka.adddel', compact('datas'))
            ->layout('layouts.app', ['header' => 'Tambah & Hapus Pustaka']);
    }
}
