<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/* Dashboard */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/* Pengaduan Konsumen */
Route::middleware('auth')->group(function () {

    // TAMPIL DATA
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    
    // STATUS PERBAIKAN
    Route::get('/status-perbaikan', [PengaduanController::class, 'index'])->name('status.index');

    // FORM TAMBAH
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');

    // SIMPAN DATA
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

    // FORM EDIT (update status)
    Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::get('/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');

    // UPDATE STATUS
    Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');

    // DELETE (opsional)
    Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

    /* Profile */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';