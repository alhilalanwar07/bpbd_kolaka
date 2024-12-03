<?php

use App\Http\Livewire\Laporan;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Poskos\DaftarPosko;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));	
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Hooks - Do not delete//
	Route::view('dokumentasis', 'livewire.dokumentasis.index')->middleware('auth');
	Route::view('barangs', 'livewire.barangs.index')->middleware('auth');
	Route::view('kebutuhan_poskos', 'livewire.kebutuhan-poskos.index')->middleware('auth');
	Route::view('stoks', 'livewire.stoks.index')->middleware('auth');
	Route::view('logistiks', 'livewire.logistiks.index')->middleware('auth');
	Route::view('poskos', 'livewire.poskos.index')->middleware('auth');
	Route::view('bencanas', 'livewire.bencanas.index')->middleware('auth');
	Route::view('kecamatans', 'livewire.kecamatans.index')->middleware('auth');
	Route::view('satuans', 'livewire.satuans.index')->middleware('auth');
	Route::view('users', 'livewire.users.index')->middleware('auth');

    // reg-posko
    Route::get('reg-posko', DaftarPosko::class);

    // laporan
    Route::get('laporan', Laporan::class)->middleware('auth');
