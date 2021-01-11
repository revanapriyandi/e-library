<?php

namespace App\Models;

use function PHPUnit\Framework\isTrue;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;

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
        return $this->photo ? asset('storage/' . $this->photo) : $this->defaultProfilePhotoUrl();
    }

    protected function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&color=7F9CF5&background=EBF4FF';
    }

    public function getStatus()
    {
        if ($this->aktif == 1) {
            $status = '<span class="badge badge-success" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Status Aktif"><i class="fa fa-smile"></i></span>';
        } else {
            $status = '<span class="badge badge-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Status Tidak Aktif"><i class="fa fa-frown"></i></span>';
        }
        return $status;
    }

    public function getPekerjaan()
    {
        if ($this->pekerjaan == null) {
            $pekerjaan = '<span class="badge badge-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pekerjaan belum ditetapkan"><i class="fa fa-exclamation-triangle"></i></span>';
        } elseif ($this->pekerjaan == 0) {
            $pekerjaan = '<span class="badge badge-success" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Siswa"><i class="fa fa-user-graduate"></i></span>';
        } elseif ($this->pekerjaan == 1) {
            $pekerjaan = '<span class="badge badge-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pegawai"><i class="fa fa-chalkboard-teacher"></i></span>';
        } else {
            $pekerjaan = '<span class="badge badge-secondary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Anggota Luar Sekolah"><i class="fa fa-user-astronaut"></i></span>';
        }
        return $pekerjaan;
    }
}