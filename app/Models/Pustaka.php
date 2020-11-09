<?php

namespace App\Models;

use App\Models\DaftarPustaka;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pustaka extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pustaka';

    public function daftarPustaka()
    {
        return $this->hasMany(DaftarPustaka::class, 'pustaka');
    }

    public function katalogs()
    {
        return $this->belongsTo(Katalog::class, 'katalog');
    }
}
