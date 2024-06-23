<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DanaMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DanaKeluarController;
use Illuminate\Support\Facades\Auth;

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



// Route khusus untuk total dana keluar selama 7 hari terakhir
// Route::get('dana_keluar/total_last_7_days', [DanaKeluarController::class, 'getTotalLast7Days'])->name('dana_keluar.total_last_7_days');

// Route::get('/dana-keluar', function () {
//     return view('dashboard/dana_keluar', [
//         "title" => "Dana Keluar"
//     ]);
// });