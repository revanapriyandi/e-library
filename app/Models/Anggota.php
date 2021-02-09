<?php

namespace App\Models;

use App\Models\Kelas;
use function PHPUnit\Framework\isTrue;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anggota';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $appends = [
        'profile_photo_url',
    ];

    public function getPicture()
    {
        return $this->photo ? url("storage/{$this->photo}") : $this->defaultProfilePhotoUrl();
    }

    protected function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&color=7F9CF5&background=EBF4FF';
    }

    public function getStatus($id)
    {
        if ($this->aktif == 1) {
            $status = '<a href="javascript:" wire:click="disable(' . $id . ')" wire:loading.class="btn disabled btn-sm btn-success btn-progress " class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Status Aktif"><i class="fa fa-smile"></i></a>';
        } else {
            $status = '<a href="javascript:" wire:click="aktivation(' . $id . ')" class="btn btn-sm btn-danger" wire:loading.class="btn disabled btn-sm btn-danger btn-progress " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Status Tidak Aktif"><i class="fa fa-frown"></i></a>';
        }
        return $status;
    }

    public function getPekerjaan()
    {
        if ($this->pekerjaan == null) {
            $pekerjaan = '<span class="badge badge-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pekerjaan belum ditetapkan"><i class="fa fa-exclamation-triangle"></i></span>';
        } elseif ($this->pekerjaan == 'siswa') {
            $pekerjaan = '<span class="badge badge-success" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Siswa"><i class="fa fa-user-graduate"></i></span>';
        } elseif ($this->pekerjaan == 'pegawai') {
            $pekerjaan = '<span class="badge badge-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pegawai"><i class="fa fa-chalkboard-teacher"></i></span>';
        } else {
            $pekerjaan = '<span class="badge badge-secondary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Anggota Luar Sekolah"><i class="fa fa-user-astronaut"></i></span>';
        }
        return $pekerjaan;
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
