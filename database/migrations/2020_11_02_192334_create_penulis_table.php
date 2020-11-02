<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenulisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penulis', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 3);
            $table->string('nama', 100);
            $table->string('kontak')->nullable();
            $table->text('biografi')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('gelar_depan', 45)->nullable();
            $table->string('gelar_belakang', 45)->nullable();
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
        Schema::dropIfExists('penulis');
    }
}
