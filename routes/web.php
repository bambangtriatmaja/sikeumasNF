<?php

use Illuminate\Http\Request;
use App\Exports\DanaMasukExport;
use App\Imports\DanaMasukImport;
use App\Exports\DanaKeluarExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DanaMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DanaKeluarController;
use App\Http\Controllers\CetakLaporanKeuanganController;

Route::get('/', [LaporanController::class, 'index']);

Route::resource('dashboard', DashboardController::class)->middleware('auth');

Route::resource('dana_masuk', DanaMasukController::class);

Route::resource('dana_keluar', DanaKeluarController::class);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
  Route::post('/logout', function () {
      Auth::logout();
      return redirect('/login');
  })->name('logout');
});

Route::get('/laporan/cetak', [CetakLaporanKeuanganController::class, 'cetakLaporan'])->name('laporan.cetak');

Route::get('/export-dana-masuk', function () {
  return Excel::download(new DanaMasukExport, 'dana_masuk_' . now()->format('Y-m-d') . '.xlsx');
});

Route::post('/import-dana-masuk', function (Request $request) {
  Excel::import(new DanaMasukImport, $request->file('file'));

  return redirect('/')->with('success', 'Data dana masuk berhasil diimpor!');
});

Route::get('/export-dana-keluar', function () {
  return Excel::download(new DanaKeluarExport, 'dana_keluar_' . now()->format('Y-m-d') . '.xlsx');
});