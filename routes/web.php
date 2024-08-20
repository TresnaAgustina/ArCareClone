<?php

use App\Http\Controllers\Admin\Akun\AkunCreateController;
use App\Http\Controllers\Admin\Akun\AkunDeleteController;
use App\Http\Controllers\Admin\Akun\AkunUpdateController;
use App\Http\Controllers\Admin\Tiket\AdminKelolaTiketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Pelanggan\Tiket\PelangganKelolaTiketController;
use App\Http\Controllers\Pelanggan\Tiket\TiketCreateController;
use App\Http\Controllers\Teknisi\Tiket\TeknisiKelolaTiketController;
use Illuminate\Support\Facades\Route;


Route::prefix('/auth')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('auth');
    Route::post('/logout', LogoutController::class)->name('logout');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
           
    // *** === ADMIN === *** //
    Route::prefix('/admin')->group(function () {
        // Kelola Akun
        Route::prefix('/akun')->group(function () {
            // GET
            Route::get('/', [AkunCreateController::class, 'index'])->name('admin.akun.index');
            Route::get('/tambah', [AkunCreateController::class, 'create'])->name('admin.akun.tambah');
            Route::get('/edit/{id}', [AkunUpdateController::class, 'index'])->name('admin.akun.edit');
            // POST
            Route::post('/store', [AkunCreateController::class, 'store'])->name('admin.akun.store');
            Route::post('/update/{id}', [AkunUpdateController::class, 'update'])->name('admin.akun.update');
            Route::delete('/delete/{id}', AkunDeleteController::class)->name('admin.akun.delete');
        });

        // Kelola Tiket
        Route::prefix('/tiket')->group(function () {
            // GET
            Route::get('/', [AdminKelolaTiketController::class, 'index'])->name('admin.tiket.index');
            Route::get('/{id}', [AdminKelolaTiketController::class, 'detail'])->name('admin.tiket.detail');
            // POST
            Route::post('/{id}/kirim_jadwal', [AdminKelolaTiketController::class, 'kirim_jadwal'])->name('admin.tiket.kirim_jadwal');
            Route::post('/{id}/penugasan', [AdminKelolaTiketController::class, 'penugasan'])->name('admin.tiket.penugasan');
            Route::post('/{id}/kirim_kendala', [AdminKelolaTiketController::class, 'kirim_kendala'])->name('admin.tiket.sampaikan_kendala');
        });
    });


    // *** === PELANGGAN === *** //
    Route::prefix('/pelanggan')->group(function () {
        // Kelola Tiket
        Route::prefix('/tiket')->group(function () {
            // GET
            Route::get('/', [PelangganKelolaTiketController::class, 'index'])->name('pelanggan.tiket.index');
            Route::get('/masuk', [PelangganKelolaTiketController::class, 'masuk'])->name('pelanggan.tiket.masuk');
            Route::get('/aktif', [PelangganKelolaTiketController::class, 'aktif'])->name('pelanggan.tiket.aktif');
            Route::get('/pending', [PelangganKelolaTiketController::class, 'pending'])->name('pelanggan.tiket.pending');
            Route::get('/selesai', [PelangganKelolaTiketController::class, 'selesai'])->name('pelanggan.tiket.selesai');
            Route::get('/dibatalkan', [PelangganKelolaTiketController::class, 'dibatalkan'])->name('pelanggan.tiket.dibatalkan');
            Route::get('/new', [PelangganKelolaTiketController::class, 'new'])->name('pelanggan.tiket.new');
            Route::get('/{id}', [PelangganKelolaTiketController::class, 'detail'])->name('pelanggan.tiket.detail');
            // POST
            Route::post('/store', TiketCreateController::class)->name('pelanggan.tiket.store');
            Route::post('/{id}/konfirmasi_jadwal', [PelangganKelolaTiketController::class, 'konfirmasi_jadwal'])->name('pelanggan.tiket.konfirmasi_jadwal');
            Route::post('/{id}/konfirmasi_kendala', [PelangganKelolaTiketController::class, 'konfirmasi_kendala'])->name('pelanggan.tiket.konfirmasi_kendala');
        });
    });

    // *** === TEKNISI === *** //
    Route::prefix('/teknisi')->group(function () {
        // Kelola Tiket
        Route::prefix('/tiket')->group(function () {
            // GET
            Route::get('/', [TeknisiKelolaTiketController::class, 'index'])->name('teknisi.tiket.index');
            Route::get('/{id}', [TeknisiKelolaTiketController::class, 'detail'])->name('teknisi.tiket.detail');
            // POST
            Route::post('/{id}/konfimasi_jadwal', [TeknisiKelolaTiketController::class, 'konfirmasi_jadwal'])->name('teknisi.tiket.konfirmasi_jadwal');
            Route::post('/{id}/lapor_kendala', [TeknisiKelolaTiketController::class, 'lapor_kendala'])->name('teknisi.tiket.lapor_kendala');
            Route::post('/{id}/lapor_selesai', [TeknisiKelolaTiketController::class, 'lapor_selesai'])->name('teknisi.tiket.lapor_selesai');
        });
    });
});

Route::get('/login', fn() => view('pages.auth.login'))->name('login');
Route::get('/user/dashboard', fn() => view('pages.user.dashboard'))->name('pelanggan.dashboard');
Route::get('/user/ticket', fn() => view('pages.user.ticket.view.view_ticket_user'));
Route::get('/user/ticket/incoming', fn() => view('pages.user.ticket.view.incoming'));
Route::get('/user/ticket/process', fn() => view('pages.user.ticket.view.process'));
Route::get('/user/ticket/add', fn() => view('pages.user.ticket.add_ticket'));
