<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OglasController;
use App\Http\Controllers\AdminOglasController;

// Autentikacija
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Oglasi - Resource routes (sa ispravnim parametrom "oglas")
Route::get('/', [OglasController::class, 'index'])->name('oglasi.index');
Route::resource('oglasi', OglasController::class)->except(['index'])->parameters([
    'oglasi' => 'oglas'
]);
Route::post('/oglasi/{oglas}/kontakt', [OglasController::class, 'kontakt'])->name('oglasi.kontakt');

// Admin routes (zaštićeno middleware-om "admin")
Route::middleware(['auth','admin'])->group(function() {
    Route::get('/admin/oglasi', [AdminOglasController::class, 'index'])->name('admin.oglasi.index');
    Route::post('/admin/oglasi/{id}/odobri', [AdminOglasController::class, 'odobri'])->name('admin.oglasi.odobri');
    Route::post('/admin/oglasi/{id}/odbij', [AdminOglasController::class, 'odbij'])->name('admin.oglasi.odbij');
    Route::get('/admin/oglasi/cekaju', [AdminOglasController::class, 'cekaju'])->name('admin.oglasi.cekaju');
});

// Statične stranice
Route::view('/onama', 'static.onama')->name('onama');
Route::view('/privatnost', 'static.privatnost')->name('privatnost');
Route::view('/kontakt', 'static.kontakt')->name('kontakt');
