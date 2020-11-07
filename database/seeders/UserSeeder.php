<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'noregistrasi' => '091020200001',
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$U6rmoxzh6v2Y00mMhHh8UuV59Af0CxmdHb5ckxSDBBl1RDY42eFD2', // admin123
            'remember_token' => Str::random(10),
        ]);
    }
}
