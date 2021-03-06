<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register'=> false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    Route::get('/', App\Http\Livewire\Admin\Dashboard::class)->name('admin.beranda');
    Route::get('/setting', App\Http\Livewire\Admin\Setting::class)->name('admin.setting');
    Route::get('/users', App\Http\Livewire\Admin\Users::class)->name('admin.users');
    Route::get('/users/admin', App\Http\Livewire\Admin\Users::class)->name('admin.users.admin');
    Route::get('/users/guru', App\Http\Livewire\Admin\Users::class)->name('admin.users.guru');
    Route::get('/users/siswa', App\Http\Livewire\Admin\Users::class)->name('admin.users.siswa');
    Route::get('/users/ortu', App\Http\Livewire\Admin\Users::class)->name('admin.users.ortu');
});

Route::group(['prefix' => 'taus', 'middleware' => ['role:taus']], function() {

});

Route::group(['prefix' => 'guru', 'middleware' => ['role:guru']], function() {

});

Route::group(['prefix' => 'siswa', 'middleware' => ['role:siswa']], function() {

});

Route::group(['prefix' => 'ortu', 'middleware' => ['role:ortu']], function() {

});
