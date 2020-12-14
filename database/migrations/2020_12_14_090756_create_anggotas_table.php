<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('noregistrasi', 20);
            $table->string('nama', 100);
            $table->string('kodepos', 6);
            $table->string('email', 100);
            $table->string('telpon', 100);
            $table->string('hp', 100);
            $table->string('pekerjaan', 100);
            $table->string('institusi', 100);
            $table->string('keterangan');
            $table->boolean('aktif')->default('1');
            $table->text('profile_photo_path')->nullable();
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
        Schema::dropIfExists('anggota');
    }
}
