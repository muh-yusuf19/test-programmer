<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\StockController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Barang
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::put('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::patch('/barang/update/{barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/delete/{barang}', [BarangController::class, 'delete'])->name('barang.delete');

    // Suplier
    Route::get('/suplier', [SuplierController::class, 'index'])->name('suplier.index');
    Route::get('/suplier/create', [SuplierController::class, 'create'])->name('suplier.create');
    Route::post('/suplier/store', [SuplierController::class, 'store'])->name('suplier.store');
    Route::put('/suplier/{suplier}/edit', [SuplierController::class, 'edit'])->name('suplier.edit');
    Route::patch('/suplier/update/{suplier}', [SuplierController::class, 'update'])->name('suplier.update');
    Route::delete('/suplier/delete/{suplier}', [SuplierController::class, 'delete'])->name('suplier.delete');

    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');

    // Stock
    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
