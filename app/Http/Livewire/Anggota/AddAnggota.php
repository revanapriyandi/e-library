<?php

namespace App\Http\Livewire\Anggota;

use Exception;
use App\Models\Kelas;
use App\Models\Anggota;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddAnggota extends Component
{
    use WithFileUploads;

    public $nama;
    public $email;
    public $hp;
    public $kelas;
    public $institusi;
    public $telpon;
    public $kodepos;
    public $alamat;
    public $keterangan;

    public $photo;
    public $job;

    public function mount()
    {
        $this->job = request()->job;
    }


    public function updated($field)
    {

        $this->validateOnly(
            $field,
            [
                'nama' => 'required|string|min:2|max:100',
                'email' => 'nullable|email|max:100',
                'hp' => 'required|string',
                'telpon' => 'nullable|max:30',
                'institusi' => 'required|string|max:100',
                'kelas' => 'required',
                'kodepos' => 'required|max:20',
                'alamat' => 'required'
            ]
        );
    }

    public function resetInputFields()
    {
        $this->nama = '';
        $this->email = '';
        $this->hp = '';
        $this->kelas = '';
        $this->institusi = '';
        $this->telpon = '';
        $this->kodepos = '';
        $this->alamat = '';
        $this->keterangan = '';
        $this->photo = '';
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:100',
            'hp' => 'required|string',
            'telpon' => 'nullable|max:30',
            'institusi' => 'required|string|max:100',
            'kelas' => $this->photo == 'siswa' ? 'required' : 'nullable',
            'kodepos' => 'required|max:20',
            'alamat' => 'required',
            'photo' => $this->photo ? 'image|mimes:png,jpeg,jpg' : '',
        ]);
        if ($this->photo) {
            $photos = $this->photo->store('anggota-image', 'public');
        } else {
            $photos =  null;
        }
        Anggota::create([
            'noregistrasi' => $this->GetNewNoregistrasi(),
            'nama' => $this->nama,
            'email' => $this->email,
            'hp' => $this->hp,
            'kelas_id' => $this->kelas,
            'institusi' => $this->institusi,
            'telpon' => $this->telpon,
            'kodepos' => $this->kodepos,
            'alamat' => $this->alamat,
            'keterangan' => $this->keterangan,
            'pekerjaan' => $this->job,
            'photo' => $photos,
        ]);
        $this->resetInputFields();
        $this->emit('resetInputs');
        $this->emit('alert', ['type' => 'success', 'message' => 'Data Berhasil ditambahkan ']);
        // } catch (Exception $e) {
        //     $this->emit('alert', ['type' => 'error', 'message' => $e]);
        // }
    }

    public function GenerateNoRegistrasi($length = 10)
    {
        $dict = "0123456789";
        $noregistrasi = "";
        for ($i = 0; $i < $length; $i++) {
            $pos = rand(0, strlen($dict) - 1);
            $noregistrasi .= substr($dict, $pos, 1);
        }

        return $noregistrasi;
    }

    public function GetNewNoregistrasi()
    {
        $noregistrasi = "";
        do {
            $noregistrasi = $this->GenerateNoRegistrasi(10);
            $row = Anggota::select('id')->where('noregistrasi', '$noregistrasi')->count();
            $ndata = (int)$row;
        } while ($ndata != 0);
        return $noregistrasi;
    }


    public function render()
    {

        return view('anggota.add-anggota', [
            'dataKelas' => Kelas::where('isAktif', true)->get(),
        ])
            ->layout('layouts.app', ['header' => 'Anggota Baru']);
    }
}
