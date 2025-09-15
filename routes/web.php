<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OglasController;
use App\Http\Controllers\AdminOglasController;
use App\Http\Controllers\AdminUserController;

// Autentikacija
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Početna + resource
Route::get('/', [OglasController::class, 'index'])->name('oglasi.index');
Route::resource('oglasi', OglasController::class)->except(['index'])->parameters([
    'oglasi' => 'oglas'
]);

// Kontakt na oglasu
Route::post('/oglasi/{oglas}/kontakt', [OglasController::class, 'kontakt'])->name('oglasi.kontakt');

// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/moji-oglasi', [OglasController::class, 'mojiOglasi'])->name('oglasi.moji');
});

// Admin rute (zaštićene middleware-om "admin")
Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/oglasi', [AdminOglasController::class, 'index']);
    Route::post('/admin/oglasi/{id}/odobri', [AdminOglasController::class, 'odobri']);
    Route::post('/admin/oglasi/{id}/odbij', [AdminOglasController::class, 'odbij']);
    Route::get('/admin/oglasi/cekaju', [AdminOglasController::class, 'cekaju'])
    ->name('admin.oglasi.cekaju');


    // ✳️ Admin – korisnici
    Route::get('/admin/korisnici', [AdminUserController::class, 'index'])->name('admin.korisnici.index');
    Route::get('/admin/korisnici/{user}', [AdminUserController::class, 'show'])->name('admin.korisnici.show');

});

// Statične stranice
Route::view('/onama', 'static.onama');
Route::view('/privatnost', 'static.privatnost');
Route::view('/kontakt', 'static.kontakt');
