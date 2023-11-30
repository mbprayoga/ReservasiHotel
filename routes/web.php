<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tamuController;
use App\Http\Controllers\kamarController;
use App\Http\Controllers\reservasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\CustomAuth;

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/login', [LoginController::class, 'create'])->name('login.create');
Route::get('/login/store', [LoginController::class, 'store'])->name('login.store');


Route::group(['middleware'=>['customAuth']],function () {
//Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

    

    Route::get('/tamu', [tamuController::class, 'index'])->name('tamu.index');
    Route::get('/tamu/add', [tamuController::class, 'create'])->name('tamu.create');
    Route::post('/tamu/store', [tamuController::class, 'store'])->name('tamu.store');
    Route::get('/tamu/edit/{id}', [tamuController::class, 'edit'])->name('tamu.edit');
    Route::post('/tamu/update/{id}', [tamuController::class, 'update'])->name('tamu.update');
    Route::post('/tamu/delete/{id}', [tamuController::class, 'delete'])->name('tamu.delete');
    Route::get('/tamu/search', [tamuController::class, 'search'])->name('tamu.search');
    Route::post('/tamu/hide/{id}', [tamuController::class, 'hide'])->name('tamu.hide');
    Route::get('/tamu/trash', [tamuController::class, 'trash'])->name('tamu.trash');
    Route::get('/tamu/restore/{id}', [tamuController::class, 'restore'])->name('tamu.restore');
    Route::get('/tamu/search/trash', [tamuController::class, 'search_trash'])->name('tamu.search_trash');

    Route::get('/kamar', [kamarController::class, 'index'])->name('kamar.index');
    Route::get('/kamar/add', [kamarController::class, 'create'])->name('kamar.create');
    Route::post('/kamar/store', [kamarController::class, 'store'])->name('kamar.store');
    Route::get('/kamar/edit/{id}', [kamarController::class, 'edit'])->name('kamar.edit');
    Route::post('/kamar/update/{id}', [kamarController::class, 'update'])->name('kamar.update');
    Route::post('/kamar/delete/{id}', [kamarController::class, 'delete'])->name('kamar.delete');
    Route::get('/kamar/search', [kamarController::class, 'search'])->name('kamar.search');
    Route::post('/kamar/hide/{id}', [kamarController::class, 'hide'])->name('kamar.hide');
    Route::get('/kamar/trash', [kamarController::class, 'trash'])->name('kamar.trash');
    Route::get('/kamar/restore/{id}', [kamarController::class, 'restore'])->name('kamar.restore');
    Route::get('/kamar/search/trash', [kamarController::class, 'search_trash'])->name('kamar.search_trash');

    Route::get('/reservasi', [reservasiController::class, 'index'])->name('reservasi.index');
    Route::get('/reservasi/add', [reservasiController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi/store', [reservasiController::class, 'store'])->name('reservasi.store');
    Route::get('/reservasi/edit/{id}', [reservasiController::class, 'edit'])->name('reservasi.edit');
    Route::post('/reservasi/update/{id}', [reservasiController::class, 'update'])->name('reservasi.update');
    Route::post('/reservasi/delete/{id}', [reservasiController::class, 'delete'])->name('reservasi.delete');
    Route::get('/reservasi/search', [reservasiController::class, 'search'])->name('reservasi.search');
    Route::post('/reservasi/hide/{id}', [reservasiController::class, 'hide'])->name('reservasi.hide');
    Route::get('/reservasi/trash', [reservasiController::class, 'trash'])->name('reservasi.trash');
    Route::get('/reservasi/restore/{id}', [reservasiController::class, 'restore'])->name('reservasi.restore');
    Route::get('/reservasi/search/trash', [reservasiController::class, 'search_trash'])->name('reservasi.search_trash');
});

