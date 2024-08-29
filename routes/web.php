<?php

use App\Http\Controllers\Admin\Akun\AkunCreateController;
use App\Http\Controllers\Admin\Akun\AkunDeleteController;
use App\Http\Controllers\Admin\Akun\AkunUpdateController;
use App\Http\Controllers\Admin\Tiket\AdminKelolaTiketController;
use App\Http\Controllers\Admin\Tiket\AdminTiketKirimJadwalController;
use App\Http\Controllers\Admin\Tiket\AdminTiketKirimKendalaController;
use App\Http\Controllers\Admin\Tiket\AdminTiketPenugasanController;
use App\Http\Controllers\Admin\Tiket\AdminTiketViewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Pelanggan\Tiket\PelangganKelolaTiketController;
use App\Http\Controllers\Pelanggan\Tiket\PelangganTiketKonfirmasiJadwalController;
use App\Http\Controllers\Pelanggan\Tiket\PelangganTiketKonfirmasiKendalaController;
use App\Http\Controllers\Pelanggan\Tiket\PelangganTiketViewController;
use App\Http\Controllers\Pelanggan\Tiket\TiketCreateController;
use App\Http\Controllers\Teknisi\Tiket\TeknisiInfoMenujuLokasiController;
use App\Http\Controllers\Teknisi\Tiket\TeknisiKelolaTiketController;
use App\Http\Controllers\Teknisi\Tiket\TeknisiLaporKendalaController;
use App\Http\Controllers\Teknisi\Tiket\TeknisiLaporSelesaiController;
use App\Http\Controllers\Teknisi\Tiket\TeknisiTiketViewController;
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
            Route::get('/', [AdminTiketViewController::class, 'index'])->name('admin.tiket.index');
            Route::get('/{id}', [AdminTiketViewController::class, 'detail'])->name('admin.tiket.detail');
            // POST
            Route::post('/{id}/kirim_jadwal', AdminTiketKirimJadwalController::class)->name('admin.tiket.kirim_jadwal');
            Route::post('/{id}/penugasan', AdminTiketPenugasanController::class)->name('admin.tiket.penugasan');
            Route::post('/{id}/kirim_kendala', AdminTiketKirimKendalaController::class)->name('admin.tiket.meneruskan_kendala');
        });
    });


    // *** === PELANGGAN === *** //
    Route::prefix('/pelanggan')->group(function () {
        // Kelola Tiket
        Route::prefix('/tiket')->group(function () {
            // GET
            Route::get('/', [PelangganTiketViewController::class, 'index'])->name('pelanggan.tiket.index');
            Route::get('/masuk', [PelangganTiketViewController::class, 'masuk'])->name('pelanggan.tiket.masuk');
            Route::get('/aktif', [PelangganTiketViewController::class, 'aktif'])->name('pelanggan.tiket.aktif');
            Route::get('/pending', [PelangganTiketViewController::class, 'pending'])->name('pelanggan.tiket.pending');
            Route::get('/selesai', [PelangganTiketViewController::class, 'selesai'])->name('pelanggan.tiket.selesai');
            Route::get('/dibatalkan', [PelangganTiketViewController::class, 'dibatalkan'])->name('pelanggan.tiket.dibatalkan');
            Route::get('/new', [PelangganTiketViewController::class, 'new'])->name('pelanggan.tiket.new');
            Route::get('/{id}', [PelangganTiketViewController::class, 'detail'])->name('pelanggan.tiket.detail');
            // POST
            Route::post('/store', TiketCreateController::class)->name('pelanggan.tiket.store');
            Route::post('/{id}/konfirmasi_jadwal', PelangganTiketKonfirmasiJadwalController::class)->name('pelanggan.tiket.konfirmasi_jadwal');
            Route::post('/{id}/konfirmasi_persetujuan', PelangganTiketKonfirmasiKendalaController::class)->name('pelanggan.tiket.konfirmasi_persetujuan');
        });
    });

    // *** === TEKNISI === *** //
    Route::prefix('/teknisi')->group(function () {
        // Kelola Tiket
        Route::prefix('/tiket')->group(function () {
            // GET
            Route::get('/', [TeknisiTiketViewController::class, 'index'])->name('teknisi.tiket.index');
            Route::get('/{id}', [TeknisiTiketViewController::class, 'detail'])->name('teknisi.tiket.detail');
            // POST
            Route::post('/{id}/menuju_lokasi', TeknisiInfoMenujuLokasiController::class)->name('teknisi.tiket.menuju_lokasi');
            Route::post('/{id}/lapor_kendala', TeknisiLaporKendalaController::class)->name('teknisi.tiket.lapor_kendala');
            Route::post('/{id}/lapor_selesai', TeknisiLaporSelesaiController::class)->name('teknisi.tiket.lapor_selesai');
        });
    });
});

Route::get('/login', fn() => view('pages.auth.login'))->name('login');
Route::get('/user/dashboard', fn() => view('pages.user.dashboard'))->name('pelanggan.dashboard');
Route::get('/user/ticket', fn() => view('pages.user.ticket.view.view_ticket_user'));
Route::get('/user/ticket/incoming', fn() => view('pages.user.ticket.view.incoming'));
Route::get('/user/ticket/process', fn() => view('pages.user.ticket.view.process'));
Route::get('/user/ticket/add', fn() => view('pages.user.ticket.add_ticket'));
