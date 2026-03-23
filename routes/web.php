<?php

use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PeminjamanAlatController as AdminPeminjamanAlatController;
use App\Http\Controllers\Admin\PeminjamController;
use App\Http\Controllers\Admin\PengembalianAlatController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\Peminjam\PeminjamanAlatController;
use App\Http\Controllers\Peminjam\PengembalianController;
use App\Http\Controllers\Petugas\PeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Crud (admin only)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth', 'role:admin'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('peminjam', PeminjamController::class);
        Route::resource('petugas', PetugasController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('alat', AlatController::class);
        Route::resource('alat', AlatController::class);
        Route::resource('peminjaman', AdminPeminjamanAlatController::class);
        Route::resource('pengembalian', PengembalianAlatController::class);
    });
});

// Crud (petugas only)
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::middleware(['auth', 'role:petugas'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('peminjaman', PeminjamanController::class);
        Route::resource('pengembalian', PetugasPengembalianController::class);
    });
});

// Crud (Peminjam only)
Route::prefix('peminjam')->name('peminjam.')->group(function () {
    Route::middleware(['auth', 'role:peminjam'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/peminjaman/create/{id}', [PeminjamanAlatController::class, 'create'])
            ->name('peminjaman.create');
        Route::resource('peminjaman', PeminjamanAlatController::class);
        Route::resource('pengembalian', PengembalianController::class);
    });
});
