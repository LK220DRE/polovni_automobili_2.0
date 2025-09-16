<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OglasController;
use App\Http\Controllers\AdminOglasController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\MarkaController;
use App\Http\Controllers\ModelController;

//  Autentikacija
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//  Početna + oglasi (resource)
Route::get('/', [OglasController::class, 'index'])->name('oglasi.index');
Route::resource('oglasi', OglasController::class)
    ->except(['index'])
    ->parameters(['oglasi' => 'oglas']);

//  Kontakt za oglas
Route::post('/oglasi/{oglas}/kontakt', [OglasController::class, 'kontakt'])->name('oglasi.kontakt');

//  Korisničke rute (samo ulogovani)
Route::middleware('auth')->group(function () {
    Route::get('/moji-oglasi', [OglasController::class, 'mojiOglasi'])->name('oglasi.moji');
});

//  Admin rute (middleware: auth + admin)
Route::middleware(['auth', 'admin'])->group(function () {
    // Moderacija oglasa
    Route::get('/admin/oglasi', [AdminOglasController::class, 'index'])->name('admin.oglasi.index');
    Route::post('/admin/oglasi/{id}/odobri', [AdminOglasController::class, 'odobri'])->name('admin.oglasi.odobri');
    Route::post('/admin/oglasi/{id}/odbij', [AdminOglasController::class, 'odbij'])->name('admin.oglasi.odbij');
    Route::get('/admin/oglasi/cekaju', [AdminOglasController::class, 'cekaju'])->name('admin.oglasi.cekaju');

    // Upravljanje korisnicima
    Route::get('/admin/korisnici', [AdminUserController::class, 'index'])->name('admin.korisnici.index');
    Route::get('/admin/korisnici/{user}', [AdminUserController::class, 'show'])->name('admin.korisnici.show');
    Route::delete('/admin/korisnici/{user}', [AdminUserController::class, 'destroy'])->name('admin.korisnici.destroy');

    // Upravljanje markama (CRUD)
    Route::resource('marke', MarkaController::class)->except(['show', 'edit', 'update']);

    // Upravljanje modelima (CRUD)
    Route::resource('modeli', ModelController::class)->except(['show', 'edit', 'update']);
});

//  Statične stranice
Route::view('/onama', 'static.onama')->name('onama');
Route::view('/privatnost', 'static.privatnost')->name('privatnost');
Route::view('/kontakt', 'static.kontakt')->name('kontakt');
