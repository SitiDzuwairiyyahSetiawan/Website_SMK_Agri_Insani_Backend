<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NavbarController;
use App\Http\Controllers\Admin\SejarahController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Admin\ProgramUnggulanController;
use App\Http\Controllers\Admin\EkstrakurikulerController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\WhatsappLogController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Route login & logout
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

// Group dengan middleware 
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Navbar (full resource)
    Route::resource('navbar', NavbarController::class)->except(['show']);

    // SEJARAH
    Route::resource('sejarah', SejarahController::class);    
    Route::get('sejarah/edit', [App\Http\Controllers\Admin\SejarahController::class, 'edit'])->name('sejarah.edit');
    Route::get('sejarah/{id}/delete', [SejarahController::class, 'confirmDelete'])->name('sejarah.delete');
    
    // VISI MISI
    Route::resource('visi-misi', VisiMisiController::class)
    ->except(['create']);
    Route::get('visi-misi/create/{type}', [VisiMisiController::class, 'create'])
        ->name('visi-misi.create');
    Route::get('visi-misi/{id}/delete', [VisiMisiController::class, 'confirmDelete'])
        ->name('visi-misi.delete');

    // SAMBUTAN
    Route::resource('sambutan', \App\Http\Controllers\Admin\SambutanController::class);
    Route::get('sambutan/{id}/delete', [\App\Http\Controllers\Admin\SambutanController::class, 'delete'])
    ->name('sambutan.delete');

    // PROGRAM UNGGULAN
    Route::get('/program-unggulan', [ProgramUnggulanController::class, 'index'])->name('program-unggulan.index');
    Route::get('/program-unggulan/create', [ProgramUnggulanController::class, 'create'])->name('program-unggulan.create');
    Route::post('/program-unggulan', [ProgramUnggulanController::class, 'store'])->name('program-unggulan.store');
    Route::get('/program-unggulan/{programUnggulan}', [ProgramUnggulanController::class, 'show'])->name('program-unggulan.show');
    Route::get('/program-unggulan/{programUnggulan}/edit', [ProgramUnggulanController::class, 'edit'])->name('program-unggulan.edit');
    Route::put('/program-unggulan/{programUnggulan}', [ProgramUnggulanController::class, 'update'])->name('program-unggulan.update');
    Route::delete('/program-unggulan/{programUnggulan}', [ProgramUnggulanController::class, 'destroy'])->name('program-unggulan.destroy');

    // EKSTRAKURIKULER
    Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler.index');
    Route::get('/ekstrakurikuler/create', [EkstrakurikulerController::class, 'create'])->name('ekstrakurikuler.create');
    Route::post('/ekstrakurikuler', [EkstrakurikulerController::class, 'store'])->name('ekstrakurikuler.store');
    Route::get('/ekstrakurikuler/{ekstrakurikuler}', [EkstrakurikulerController::class, 'show'])->name('ekstrakurikuler.show');
    Route::get('/ekstrakurikuler/{ekstrakurikuler}/edit', [EkstrakurikulerController::class, 'edit'])->name('ekstrakurikuler.edit');
    Route::put('/ekstrakurikuler/{ekstrakurikuler}', [EkstrakurikulerController::class, 'update'])->name('ekstrakurikuler.update');
    Route::delete('/ekstrakurikuler/{ekstrakurikuler}', [EkstrakurikulerController::class, 'destroy'])->name('ekstrakurikuler.destroy');

    // BERITA
    Route::resource('berita', BeritaController::class)->except(['show']);
    Route::get('berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
    Route::get('berita/{slug}/delete', [BeritaController::class, 'delete'])->name('berita.delete'); // Halaman konfirmasi delete
    Route::patch('berita/{slug}/publish', [BeritaController::class, 'publish'])->name('berita.publish');

    // PENGUMUMAN
    Route::resource('pengumuman', PengumumanController::class)->except(['show']);
    Route::get('pengumuman/{slug}', [PengumumanController::class, 'show'])->name('pengumuman.show');
    Route::patch('pengumuman/{slug}/publish', [PengumumanController::class, 'publish'])->name('pengumuman.publish');
    Route::get('pengumuman/{slug}/delete', [PengumumanController::class, 'delete'])->name('pengumuman.delete');

    // GALERI
    Route::resource('galeri', GaleriController::class);

    // KONTAK
    Route::get('/kontak/export', [ExportController::class, 'kontak'])->name('kontak.export');
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
    Route::get('/kontak/{id}', [KontakController::class, 'show'])->name('kontak.show');
    Route::patch('/kontak/{id}/tandai-dibaca', [KontakController::class, 'tandaiDibaca'])->name('kontak.tandai-dibaca');
    Route::post('/kontak/{id}/balas', [KontakController::class, 'balas'])->name('kontak.balas');
    Route::post('/kontak/save-balasan', [KontakController::class, 'saveBalasan'])->name('kontak.save-balasan');
    Route::delete('/kontak/{id}', [KontakController::class, 'destroy'])->name('kontak.destroy');
    Route::get('/kontak/{id}/delete', [KontakController::class, 'confirmDelete'])->name('kontak.delete');
    
    // PENDAFTARAN
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])
        ->name('pendaftaran.index');

    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])
        ->name('pendaftaran.show');

    Route::get('/pendaftaran/{id}/edit', [PendaftaranController::class, 'edit'])
        ->name('pendaftaran.edit');

    Route::put('/pendaftaran/{id}', [PendaftaranController::class, 'update'])
        ->name('pendaftaran.update');

    Route::put('/pendaftaran/{id}/status', [PendaftaranController::class, 'updateStatus'])
    ->name('pendaftaran.updateStatus');

    Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])
        ->name('pendaftaran.destroy');

    Route::get('/pendaftaran/{id}/download/{type}', [PendaftaranController::class, 'download'])
        ->name('pendaftaran.download');

    // SLIDER
    Route::resource('slider', App\Http\Controllers\Admin\SliderController::class);

    // WHATSAPP LOGS
    Route::resource('whatsapp-logs', WhatsappLogController::class)->only(['index', 'show', 'destroy']);
    Route::patch('whatsapp-logs/{id}/status', [WhatsappLogController::class, 'updateStatus'])->name('whatsapp-logs.updateStatus');

    // EXPORT
    Route::get('/export/kontak', [ExportController::class, 'kontak'])
        ->name('kontak.export');

    Route::get('/export/pendaftaran', [ExportController::class, 'pendaftaran'])
        ->name('pendaftaran.export');

    Route::get('/export/whatsapp', [ExportController::class, 'whatsapp'])
        ->name('whatsapp.export');

});