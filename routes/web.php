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
use App\Http\Controllers\TemaController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\DataTerusanController;
use App\Http\Controllers\FormatSuratController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NotaDinasController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\ArsipProcurementController;

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
// Route::middleware(['auth', 'admin'])->group(function(){
//     Route::get('/pesan', [ContactController::class, 'index'])->name('pesan');
//     Route::delete('/pesan/{id}', [ContactController::class, 'destroy'])->name('pesan.delete');
//     Route::get('/pesan/{id}', [ContactController::class, 'detail'])->name('pesan.detail');
// });
// Route::get('/kontak', [ContactController::class, 'showContactForm'])->name('kontak');
// Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

Route::middleware('auth')->group(function() {
    Route::get('/statistic', [StatisticsController::class, 'statisticKeterangan'])->name('statistic.page');
});


Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/setting', [TemaController::class, 'index'])->name('tema');
    Route::get('/setting/create', [TemaController::class, 'create'])->name('tema.create');
    Route::post('/setting/store', [TemaController::class, 'store'])->name('tema.store');
    Route::get('/setting/edit/{tema}', [TemaController::class, 'edit'])->name('tema.edit');
    Route::put('/setting/{temaId}', [TemaController::class,'update'])->name('tema.update');
});

Route::get('/', [TemaController::class, 'viewTheme'])->name('view.theme');
Route::get('/kontak', [TemaController::class, 'viewThemeInContact'])->name('view.theme.contact');

// DASHBOARD
Route::middleware('auth')->group(function(){
    Route::get('/arsip-terbaru', [ArsipController::class, 'getArsipTerbaru'])->name('arsip.terbaru');
    Route::get('/userLogin', [UserController::class, 'loggedInUser']) -> name('user.logined');
});

// MASTER
Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/master', [MasterController::class, 'index'])->name('master.index');
});

// TERUSAN
Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/terusan', [DataTerusanController::class, 'index'])->name('terusan');
    Route::get('/terusan/create', [DataTerusanController::class, 'create'])->name('terusan.create');
    Route::post('/terusan/store', [DataTerusanController::class, 'store'])->name('terusan.store');
    Route::get('/terusan/{terusan}/edit', [DataTerusanController::class, 'edit'])->name('terusan.edit');
    Route::put('/terusan/{terusan}/update', [DataTerusanController::class, 'update'])->name('terusan.update');
    Route::delete('/terusan/{id}', [DataTerusanController::class, 'destroy'])->name('terusan.delete');
});

Route::middleware('auth')->group(function(){
    Route::get('/format/user', [FormatSuratController::class, 'indexForUser'])->name('format.user.index');
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/format', [FormatSuratController::class, 'index'])->name('format.index');
    Route::get('/format/create', [FormatSuratController::class, 'create'])->name('format.create');
    Route::post('/format', [FormatSuratController::class, 'store'])->name('format.store');
    Route::get('/format/{format}/edit', [FormatSuratController::class, 'edit'])->name('format.edit');
    Route::put('/format/{format}', [FormatSuratController::class, 'update'])->name('format.update');
    Route::delete('/format/{format}', [FormatSuratController::class, 'destroy'])->name('format.delete');
    Route::post('/upload-preview', [FormatSuratController::class, 'uploadPreview'])->name('upload.preview');
});

Route::middleware('auth')->group(function(){
    Route::get('/NotaDinas/{arsipId}/Create', [NotaDinasController::class, 'create'])->name('nota-dinas.create');
    Route::get('/NotaDinas/edit/{notaDinasId}', [NotaDinasController::class, 'edit'])->name('nota-dinas.edit');
    Route::post('/NotaDinas/store', [NotaDinasController::class, 'store'])->name('nota-dinas.store');
    Route::put('/NotaDinas/{notaDinasId}', [NotaDinasController::class, 'update'])->name('nota-dinas.update');
});

Route::middleware('auth')->group(function(){
    Route::get('/procurement', [ProcurementController::class, 'index'])->name('procurement.index');
    Route::get('/procurement/create', [ProcurementController::class, 'create'])->name('procurement.create');
    Route::get('/procurement/edit/{procurementId}', [ProcurementController::class, 'edit'])->name('procurement.edit');
    Route::post('/procurement/store', [ProcurementController::class, 'store'])->name('procurement.store');
    Route::put('/procurement/{procurementId}', [ProcurementController::class, 'update'])->name('procurement.update');
    Route::delete('/procurement/{procurementId}', [ProcurementController::class, 'destroy'])->name('procurement.delete');
    Route::get('/procurement/{procurementId}', [ProcurementController::class, 'details'])->name('procurement.details');
});

Route::middleware('auth')->group(function(){
    Route::get('/procurement/surat/{procurement_id}/create', [ArsipProcurementController::class, 'create'])->name('procurement.surat.create');
    Route::post('/procurement/surat/store', [ArsipProcurementController::class, 'store'])->name('procurement.surat.store');
});

require __DIR__.'/auth.php';

