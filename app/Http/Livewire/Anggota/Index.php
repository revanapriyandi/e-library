<?php

namespace App\Http\Livewire\Anggota;

use Exception;
use App\Models\Anggota;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use App\Notifications\Anggota\AkunReAktif;
use App\Notifications\Anggota\AkunNonaktif;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $query = '';
    public $updatesQueryString = ['page'];

    public function disable($id)
    {
        try {
            $user =  Anggota::findOrFail($id);
            $user->update(['aktif' => false]);
            $this->emit('alert', ['type' => 'success', 'message' => 'User dengan NoRegistrasi <strong>' . $user->noregistrasi . '</strong> telah dinonaktifkan!']);
            $user->notify(new AkunNonaktif($user));
        } catch (Exception $e) {
            $this->emit('alert', ['type' => 'error', 'message' => $e]);
        }
    }
    public function aktivation($id)
    {
        try {
            $user =  Anggota::findOrFail($id);
            $user->update(['aktif' => true]);
            $this->emit('alert', ['type' => 'success', 'message' => 'User dengan NoRegistrasi <strong>' . $user->noregistrasi . '</strong> telah berhasil diaktifkan!']);
            $user->notify(new AkunReAktif($user));
        } catch (Exception $e) {
            $this->emit('alert', ['type' => 'error', 'message' => $e]);
        }
    }

    public function destroy($id)
    {
        try {
            $anggota = Anggota::findOrFail($id);
            Storage::delete($anggota->photo);
            $anggota->delete();
            $this->emit('alert', ['type' => 'success', 'message' => 'User berhasil dihapus !']);
        } catch (Exception $e) {
            $this->emit('alert', ['type' => 'error', 'message' => $e]);
        }
    }

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
