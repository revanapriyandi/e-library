<?php

namespace App\Models;

use App\Models\Pustaka;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarPustaka extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'daftar_pustaka';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function dataPustaka()
    {
        return $this->belongsTo(Pustaka::class, 'pustaka');
    }

    public function getStatusedAttribute()
    {
        return $this->status ? '<span class="badge badge-primary">Tersedia</span>' : '<span class="badge badge-success">Dipinjam</span>';
    }
}
