<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pinjam');
            $table->date('tg_kembali');
            $table->string('keterangan');
            $table->string('id_anggota');
            $table->string('nis', 20)->nullable();
            $table->string('nip', 30)->nullable();
            $table->string('id_member', 20)->nullable();
            $table->boolean('status')->default('0');
            $table->date('tgl_diterima');
            $table->string('petugas_pinjam', 50)->nullable();
            $table->string('petugas_kembali', 50)->nullable();
            $table->string('info1')->nullable();
            $table->string('info2')->nullable();
            $table->string('info3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjam');
    }
}
