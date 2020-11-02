<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePustakasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pustaka', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('abstraksi');
            $table->string('keyword');
            $table->foreignId('tahun');
            $table->string('keteranganfisik');
            $table->foreignId('penulis');
            $table->foreignId('penerbit');
            $table->foreignId('format');
            $table->foreignId('katalog');
            $table->string('cover')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('info1')->nullable();
            $table->string('info2')->nullable();
            $table->string('info3')->nullable();
            $table->foreignId('harga');

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
        Schema::dropIfExists('pustaka');
    }
}
