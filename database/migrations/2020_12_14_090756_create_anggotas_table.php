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
            $table->foreignId('kelas_id');
            $table->text('alamat');
            $table->string('kodepos', 6)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('telpon', 100)->nullable();
            $table->string('hp', 100)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('institusi', 100)->nullable();
            $table->string('keterangan')->nullable();;
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
