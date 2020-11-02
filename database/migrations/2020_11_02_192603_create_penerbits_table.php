<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerbitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerbit', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 3);
            $table->string('nama', 100);
            $table->string('alamat')->nullable();
            $table->string('telpon', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('fax', 100)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('kontak', 100)->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('penerbit');
    }
}
