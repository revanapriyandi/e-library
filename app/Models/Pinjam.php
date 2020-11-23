<?php

namespace App\Models;

use App\Models\User;
use App\Models\DaftarPustaka;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pinjam extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pinjam';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function anggota()
    {
        return $this->belongsTo(User::class, 'id_anggota');
    }

    public function daftarPustaka()
    {
        return $this->belongsTo(DaftarPustaka::class, 'kodepustaka');
    }

    public function getKodeAnggotaAttribute()
    {
        if (!empty($this->anggota->nis)) {
            return $this->anggota->nis;
        } elseif (!empty($this->anggota->nip)) {
            return $this->anggota->nip;
        } else {
            return $this->id_anggota;
        }
    }
    public function telat()
    {
        $t = date_create($this->tgl_kembali);
        $n = date_create(date('Y-m-d'));
        $terlambat = date_diff($t, $n);
        $hari = $terlambat->format("%a");
        if ($this->tgl_kembali == date("Y-m-d")) {
            $telat = '<span class="badge badge-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Hari&nbsp;ini&nbsp;batas&nbsp;pengembalian&nbsp;terakhir"><i class="fa fa-exclamation-triangle"></i></span>';
        } elseif ($this->tgl_kembali < date('Y-m-d')) {
            $telat = '<span class="badge badge-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Terlambat&nbsp;' . $hari . '&nbsp;hari">' . $hari . '</span>';
        } else {
            $telat = '<span class="badge badge-success" ><i class="fa fa-clock"></i></span>';
        }
        return $telat;
    }
}
