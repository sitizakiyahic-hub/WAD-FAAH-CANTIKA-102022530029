
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AlamatPengirimanController;


Route::get('/', function () {
    return redirect()->route('pelanggan.index');
});


Route::get('/pelanggan', [PelangganController::class, 'index'])
    ->name('pelanggan.index');

Route::get('/pelanggan/create', [PelangganController::class, 'create'])
    ->name('pelanggan.create');

Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])
    ->name('pelanggan.edit');

Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])
    ->name('pelanggan.update');

Route::post('/pelanggan', [PelangganController::class, 'store'])
    ->name('pelanggan.store');

Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])
    ->name('pelanggan.destroy');


Route::get('/alamat', [AlamatPengirimanController::class, 'index'])
    ->name('alamat.index');

Route::get('/alamat/{id}/edit', [AlamatPengirimanController::class, 'edit'])
    ->name('alamat.edit');

Route::post('/alamat', [AlamatPengirimanController::class, 'store'])
    ->name('alamat.store');

Route::put('/alamat/{id}', [AlamatPengirimanController::class, 'update'])
    ->name('alamat.update');

Route::delete('/alamat/{id}', [AlamatPengirimanController::class, 'destroy'])
    ->name('alamat.destroy');

    