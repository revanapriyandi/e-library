<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;

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

Route::get('/user/profile', [UserProfileController::class, 'show'])
    ->name('profile.show');

Route::get('/user/profile/update-password', App\Http\Livewire\Profile\UpdatePasswordInformation::class)->name('profile.update-password');
Route::get('/user/profile/update-profile', App\Http\Livewire\Profile\UpdateProfileInformation::class)->name('profile.update-profile');
Route::get('/user/profile/update-lainnya', App\Http\Livewire\Profile\UpdateInformationLainnya::class)->name('profile.update-lainnya');
