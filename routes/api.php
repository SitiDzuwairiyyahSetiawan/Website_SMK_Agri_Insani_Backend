<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\NavbarController;
use App\Http\Controllers\API\Profil\SejarahController;
use App\Http\Controllers\API\Profil\VisiMisiController;
use App\Http\Controllers\API\Profil\ProgramUnggulanController;
use App\Http\Controllers\API\Profil\EkstrakurikulerController;
use App\Http\Controllers\API\Publikasi\BeritaController;
use App\Http\Controllers\API\Publikasi\PengumumanController;
use App\Http\Controllers\API\GaleriController;
use App\Http\Controllers\API\KontakController;
use App\Http\Controllers\API\PesanController;
use App\Http\Controllers\API\PendaftaranController;
use App\Http\Controllers\API\Profil\SambutanController;
use App\Http\Controllers\API\WhatsappLogController;

// ============ PUBLIC ROUTES ============

// Navbar
Route::get('/navbar', [NavbarController::class, 'index']);

// Profil
Route::get('/sejarah', [SejarahController::class, 'index']);
Route::get('/visi-misi', [VisiMisiController::class, 'index']);
Route::get('/sambutan', [SambutanController::class, 'index']);
Route::get('/program-unggulan', [ProgramUnggulanController::class, 'index']);
Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index']);

// Publikasi
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{slug}', [BeritaController::class, 'show']);
Route::get('/pengumuman', [PengumumanController::class, 'index']);
Route::get('/pengumuman/{slug}', [PengumumanController::class, 'show']);

// Galeri
Route::get('/galeri', [GaleriController::class, 'index']);

// Slider
Route::get('/sliders', [App\Http\Controllers\API\SliderController::class, 'index']);

// ============ KONTAK (FORM KONTAK / PESAN) ============
// Route untuk kontak dan pesan
Route::post('/kontak', [KontakController::class, 'store']);
Route::get('/kontak', [KontakController::class, 'index']);
Route::get('/admin-whatsapp', [KontakController::class, 'getAdminWhatsapp']);


// ================= PENDAFTARAN (FIX UTAMA) =================
Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::post('/pendaftaran', [PendaftaranController::class, 'store']);
Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show']);

// WhatsApp Log (public route for frontend to save logs)
Route::post('/whatsapp-log', [WhatsappLogController::class, 'store']);
Route::patch('/whatsapp-log/{id}/terkirim', [WhatsappLogController::class, 'updateStatus']);

// ============ ADMIN ROUTES (memerlukan auth) ============
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Navbar
    Route::post('/navbar', [NavbarController::class, 'store']);
    Route::get('/navbar/{id}', [NavbarController::class, 'show']);
    Route::put('/navbar/{id}', [NavbarController::class, 'update']);
    Route::delete('/navbar/{id}', [NavbarController::class, 'destroy']);

    // Sejarah
    Route::post('/sejarah', [SejarahController::class, 'store']);
    Route::get('/sejarah', [SejarahController::class, 'index']);
    Route::get('/sejarah/{id}', [SejarahController::class, 'show']);
    Route::put('/sejarah/{id}', [SejarahController::class, 'update']);
    Route::delete('/sejarah/{id}', [SejarahController::class, 'destroy']);

    // Visi Misi
    Route::get('/visi-misi', [VisiMisiController::class, 'index']);
    Route::post('/visi-misi', [VisiMisiController::class, 'store']);
    Route::get('/visi-misi/{id}', [VisiMisiController::class, 'show']);
    Route::put('/visi-misi/{id}', [VisiMisiController::class, 'update']);
    Route::delete('/visi-misi/{id}', [VisiMisiController::class, 'destroy']);

    // Sambutan
    Route::post('/sambutan', [SambutanController::class, 'store']);
    Route::get('/sambutan/{id}', [SambutanController::class, 'show']);
    Route::put('/sambutan/{id}', [SambutanController::class, 'update']);
    Route::delete('/sambutan/{id}', [SambutanController::class, 'destroy']);

    // Program Unggulan
    Route::post('/program-unggulan', [ProgramUnggulanController::class, 'store']);
    Route::get('/program-unggulan/{id}', [ProgramUnggulanController::class, 'show']);
    Route::put('/program-unggulan/{id}', [ProgramUnggulanController::class, 'update']);
    Route::delete('/program-unggulan/{id}', [ProgramUnggulanController::class, 'destroy']);

    // Ekstrakurikuler
    Route::post('/ekstrakurikuler', [EkstrakurikulerController::class, 'store']);
    Route::get('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'show']);
    Route::put('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'update']);
    Route::delete('/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'destroy']);

    // Berita
    Route::post('/berita', [BeritaController::class, 'store']);
    Route::get('/berita/show/{id}', [BeritaController::class, 'show']);
    Route::put('/berita/{id}', [BeritaController::class, 'update']);
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy']);

    // Pengumuman
    Route::post('/pengumuman', [PengumumanController::class, 'store']);
    Route::get('/pengumuman/show/{id}', [PengumumanController::class, 'show']);
    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update']);
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy']);

    // Galeri
    Route::post('/galeri', [GaleriController::class, 'store']);
    Route::get('/galeri/{id}', [GaleriController::class, 'show']);
    Route::put('/galeri/{id}', [GaleriController::class, 'update']);
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy']);

    // ============ KONTAK ADMIN ============
    Route::get('/kontak', [KontakController::class, 'index']);
    Route::get('/kontak/{id}', [KontakController::class, 'show']);
    Route::put('/kontak/{id}', [KontakController::class, 'update']);
    Route::delete('/kontak/{id}', [KontakController::class, 'destroy']);
    Route::patch('/kontak/{id}/status', [KontakController::class, 'updateStatus']); // untuk update status (pending/dibaca/dibalas)

    // Pendaftaran (admin only)
    Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
    Route::post('/pendaftaran', [PendaftaranController::class, 'store']);
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show']);
    Route::put('/pendaftaran/{id}', [PendaftaranController::class, 'update']);
    Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy']);

    // WhatsApp Log (admin view only)
    Route::get('/whatsapp-log', [WhatsappLogController::class, 'index']);
});