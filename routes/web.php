<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApotekController;
use App\Http\Controllers\RekrutmenController;
use App\Http\Controllers\FarmasiController;
use App\Http\Controllers\FKTPController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PicPrbController;
use App\Http\Controllers\PicFktpController;
use App\Http\Controllers\PicApotekController;
use App\Http\Controllers\PicRsController;
use App\Http\Controllers\KunjunganFktpController;
use App\Http\Controllers\KunjunganApotekController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ExportController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Publik
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute Registrasi (hanya untuk guest/tamu)
Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

// Rute yang memerlukan Autentikasi
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- CRUD Routes yang disederhanakan ---

    // Apotek
    Route::resource('apoteks', ApotekController::class);
    Route::get('/apoteks/{apotek}/obats', [ObatController::class, 'byApotek'])->name('obats.byApotek');
    Route::get('/apoteks/{apotek}/obats/create', [ObatController::class, 'createForApotek'])->name('obats.createForApotek');

    // Obat
    // Tambahkan ini dulu
    Route::get('obats/kosong', [ObatController::class, 'obatKosong'])->name('obats.kosong');

    // Baru route resource
    Route::resource('obats', ObatController::class);
    // Rekrutmen
    Route::resource('rekrutmens', RekrutmenController::class);
    Route::get('/rekrutmens/peserta/{jkn}', [RekrutmenController::class, 'show'])->name('rekrutmens.show');

    // Farmasi
    Route::resource('farmasis', FarmasiController::class);
    Route::get('/farmasis/{farmasi}/peserta', [FarmasiController::class, 'peserta'])->name('farmasis.peserta');

    // FKTP
    Route::resource('fktps', FKTPController::class);
    Route::get('/fktps/{fktp}/peserta', [FKTPController::class, 'peserta'])->name('fktps.peserta');

    // PIC PRB
    Route::resource('pic-prbs', PicPrbController::class);

    // --- Rute dengan Prefix ---

    // PIC FKTP (Nested under PIC PRB)
    Route::prefix('pic-prbs/{picPrb}/fktps')->name('pic-fktps.')->group(function () {
        Route::get('/', [PicFktpController::class, 'index'])->name('index');
        Route::get('/create', [PicFktpController::class, 'create'])->name('create');
        Route::post('/', [PicFktpController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PicFktpController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PicFktpController::class, 'update'])->name('update');
        Route::delete('/{id}', [PicFktpController::class, 'destroy'])->name('destroy');
    });

    // PIC Apotek (Nested under PIC PRB)
    Route::prefix('pic-prbs/{picPrb}/apoteks')->name('pic-apoteks.')->group(function () {
        Route::get('/', [PicApotekController::class, 'index'])->name('index');
        Route::get('/create', [PicApotekController::class, 'create'])->name('create');
        Route::post('/', [PicApotekController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PicApotekController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PicApotekController::class, 'update'])->name('update');
        Route::delete('/{id}', [PicApotekController::class, 'destroy'])->name('destroy');
    });

    // PIC RS (Nested under PIC PRB)
    Route::prefix('pic-prbs/{picPrb}/rs')->name('pic-rs.')->group(function () {
        Route::get('/', [PicRsController::class, 'index'])->name('index');
        Route::get('/create', [PicRsController::class, 'create'])->name('create');
        Route::post('/', [PicRsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PicRsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PicRsController::class, 'update'])->name('update');
        Route::delete('/{id}', [PicRsController::class, 'destroy'])->name('destroy');
    });

    // --- Rute Kunjungan ---

    // Kunjungan FKTP
    Route::get('/kunjungan-fktp/create/{rekrutmen}', [KunjunganFktpController::class, 'create'])->name('kunjungan_fktp.create');
    Route::post('/kunjungan-fktp/store', [KunjunganFktpController::class, 'store'])->name('kunjungan_fktp.store');

    // Kunjungan Apotek
    Route::get('/kunjungan-apotek/create/{rekrutmen}', [KunjunganApotekController::class, 'create'])->name('kunjungan_apotek.create');
    Route::post('/kunjungan-apotek/store', [KunjunganApotekController::class, 'store'])->name('kunjungan_apotek.store');

    Route::get('/export-rekrutmen', [ExportController::class, 'export']);
    Route::get('/export-rekrutmen', [ExportController::class, 'export'])->name('rekrutmen.export');
    Route::patch('/rekrutmens/{id}/status', [RekrutmenController::class, 'updateStatus'])->name('rekrutmens.updateStatus');
});


// Auth routes dari Laravel Breeze atau Jetstream
require __DIR__.'/auth.php';
