<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('noregistrasi', 20);
            $table->string('nama', 100);
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('alamat', 100)->nullable();
            $table->string('kodepos', 6)->nullable();
            $table->string('telpon', 100)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->foreignId('kelas_id', 20)->nullable();
            $table->string('keterangan')->nullable();
            $table->boolean('aktif')->default('1');
            $table->text('profile_photo_path')->nullable();
            $table->string('info1')->nullable();
            $table->string('info2')->nullable();
            $table->string('info3')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
