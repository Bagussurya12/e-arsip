<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UndanganController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/users', [UserController::class, 'index'])->name('users'); 
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); 
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth') -> group(function(){
    Route::get('/arsip', [ArsipController::class, 'index'])-> name('arsip');
    Route::get('/arsip/create', [ArsipController::class, 'create'])->name('arsip.create'); 
    Route::post('/arsip/store', [ArsipController::class, 'store'])->name('arsip.store');
    Route::get('/arsip/edit/{arsipId}', [ArsipController::class, 'edit'])->name('arsip.edit');
    Route::get('/arsip/detail/{arsipId}', [ArsipController::class, 'arsip_detail'])->name('arsip.detail');
    Route::put('/arsip/{arsipId}', [ArsipController::class,'update'])->name('arsip.update');
    Route::delete('/arsip/{id}', [ArsipController::class, 'destroy'])->name('arsip.delete');

});

Route::middleware('auth')->group(function(){
    Route::post('/undangan', [UndanganController::class, 'store'])->name('undangan.store');
});
// UNTUK DI WELCOME.VUE

Route::get('/', [ArsipController::class, 'getDataArsip'])->name('get.data.arsip');
Route::get('detail/{id}', [ArsipController::class, 'detail'])->name('detail.arsip');

// KONTAK 
Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/pesan', [ContactController::class, 'index'])->name('pesan');
    Route::delete('/pesan/{id}', [ContactController::class, 'destroy'])->name('pesan.delete');
    Route::get('/pesan/{id}', [ContactController::class, 'detail'])->name('pesan.detail');
});
Route::get('/kontak', [ContactController::class, 'showContactForm'])->name('kontak');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

Route::middleware('auth')->group(function() {
    Route::get('/statistic', [StatisticsController::class, 'statisticKeterangan'])->name('statistic.page');
});



require __DIR__.'/auth.php';

