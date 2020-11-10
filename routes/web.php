<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormatController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PustakaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/user/profile', [UserProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/user/profile/update-password', App\Http\Livewire\Profile\UpdatePasswordInformation::class)->name('profile.update-password');
    Route::get('/user/profile/update-profile', App\Http\Livewire\Profile\UpdateProfileInformation::class)->name('profile.update-profile');
    Route::get('/user/profile/update-lainnya', App\Http\Livewire\Profile\UpdateInformationLainnya::class)->name('profile.update-lainnya');

    Route::get('/referensi/daftar-format-pustaka', App\Http\Livewire\Format\Index::class)->name('format.index');

    Route::get('/referensi/daftar-rak-pustaka', App\Http\Livewire\Rak\Index::class)->name('rak.index');

    Route::get('/referensi/daftar-katalog-pustaka', App\Http\Livewire\Katalog\Index::class)->name('katalog.index');

    Route::get('/referensi/daftar-penerbit', App\Http\Livewire\Penerbit\Index::class)->name('penerbit.index');

    Route::get('/referensi/daftar-penulis', App\Http\Livewire\Penulis\Index::class)->name('penulis.index');

    Route::get('/pustaka/daftar-pustaka', App\Http\Livewire\Pustaka\Index::class)->name('pustaka.index');
    Route::get('/pustaka/pustaka-baru', App\Http\Livewire\Pustaka\AddPustaka::class)->name('pustaka.create');
    Route::get('/pustaka/pustaka-print-nomor/{id}', [PustakaController::class, 'printNomor'])->name('pustaka.print-nomor');
    Route::get('/pustaka/pustaka-tambah-&-hapus-pustaka/{id}', App\Http\Livewire\Pustaka\Adddel::class)->name('pustaka.adddel');


    Route::get('/settings', App\Http\Livewire\Settings\Index::class)->name('settings.index');
});
