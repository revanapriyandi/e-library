<?php

namespace App\Models;

use App\Models\Pustaka;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Format extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = ['kode', 'nama', 'keterangan'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'format';

    public function pustaka()
    {
        return $this->hasOne(Pustaka::class, 'format');
    }
}
