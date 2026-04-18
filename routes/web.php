<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\SerahTerimaKunciController;
use App\Http\Controllers\KonsumenDashboardController;
use App\Http\Controllers\LaporanController;
use App\Models\Pengaduan;
use App\Models\SerahTerimaKunci;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /* ================= DASHBOARD ADMIN ================= */
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'konsumen') {
            return redirect()->route('konsumen.dashboard');
        }

        $jumlahSerahTerima = SerahTerimaKunci::count();
        $jumlahPengaduan = Pengaduan::count();
        $jumlahTugasPerbaikan = Pengaduan::whereIn('status', [
            'diteruskan_lapangan',
            'dikerjakan',
        ])->count();
        $jumlahLaporan = Pengaduan::where('status', 'selesai')->count();

        return view('dashboard', compact(
            'jumlahSerahTerima',
            'jumlahPengaduan',
            'jumlahTugasPerbaikan',
            'jumlahLaporan'
        ));
    })->name('dashboard');


    /* ================= PENGADUAN ================= */
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

    Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::get('/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

    /* STATUS PERBAIKAN */
    Route::get('/status-perbaikan', [PengaduanController::class, 'index'])->name('status.index');


    /* ================= SERAH TERIMA KUNCI ================= */
    Route::get('/serah-terima', [SerahTerimaKunciController::class, 'index'])->name('serah-terima.index');
    Route::get('/serah-terima/create', [SerahTerimaKunciController::class, 'create'])->name('serah-terima.create');
    Route::post('/serah-terima', [SerahTerimaKunciController::class, 'store'])->name('serah-terima.store');
    Route::get('/serah-terima/{id}/edit', [SerahTerimaKunciController::class, 'edit'])->name('serah-terima.edit');
    Route::put('/serah-terima/{id}', [SerahTerimaKunciController::class, 'update'])->name('serah-terima.update');
    Route::delete('/serah-terima/{id}', [SerahTerimaKunciController::class, 'destroy'])->name('serah-terima.destroy');

    /* ================= LAPORAN ================= */
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');

    /* ================= PROFILE ================= */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| KONSUMEN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/konsumen/dashboard', [KonsumenDashboardController::class, 'index'])
        ->name('konsumen.dashboard');

});
