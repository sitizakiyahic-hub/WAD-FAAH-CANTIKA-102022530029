<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AlamatPengirimanController;
use App\Http\Controllers\PembagianRoleController;

Route::get('/', function () {
    return redirect()->route('pembagian-role.index');
});

// CRUD Pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index'])
    ->name('pelanggan.index');

Route::get('/pelanggan/create', [PelangganController::class, 'create'])
    ->name('pelanggan.create');

Route::post('/pelanggan', [PelangganController::class, 'store'])
    ->name('pelanggan.store');

Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])
    ->name('pelanggan.edit');

Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])
    ->name('pelanggan.update');

Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])
    ->name('pelanggan.destroy');

// CRUD Alamat Pengiriman
Route::get('/alamat', [AlamatPengirimanController::class, 'index'])
    ->name('alamat.index');

Route::post('/alamat', [AlamatPengirimanController::class, 'store'])
    ->name('alamat.store');

Route::get('/alamat/{id}/edit', [AlamatPengirimanController::class, 'edit'])
    ->name('alamat.edit');

Route::put('/alamat/{id}', [AlamatPengirimanController::class, 'update'])
    ->name('alamat.update');

Route::delete('/alamat/{id}', [AlamatPengirimanController::class, 'destroy'])
    ->name('alamat.destroy');

// Pembagian Role
Route::get('/pembagian-role', [PembagianRoleController::class, 'index'])
    ->name('pembagian-role.index');

Route::post('/atur-role', [PembagianRoleController::class, 'atur'])
    ->name('pembagian-role.atur');

Route::post('/keluar-role', [PembagianRoleController::class, 'keluar'])
    ->name('pembagian-role.keluar');