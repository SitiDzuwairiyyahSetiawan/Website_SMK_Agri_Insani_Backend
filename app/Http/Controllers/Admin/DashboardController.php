<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Pendaftaran;
use App\Models\Galeri;
use App\Models\ProgramUnggulan;
use App\Models\Ekstrakurikuler;
use App\Models\Kontak;
use App\Models\WhatsappLog;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $totalBerita = Berita::count();

        $totalPengumuman = Pengumuman::count();

        $totalPendaftar = Pendaftaran::count();

        $totalGaleri = Galeri::count();

        // TAMBAHAN
        $totalKontak = Kontak::count();

        $totalWhatsapp = WhatsappLog::count();

        // Chart tambahan
        $totalProgramUnggulan = ProgramUnggulan::count();

        $totalEkstrakurikuler = Ekstrakurikuler::count();

        // Data terbaru
        $beritaTerbaru = Berita::latest()->take(5)->get();

        $pendaftarTerbaru = Pendaftaran::latest()->take(5)->get();

        return view('admin.dashboard.index', compact(
            'totalBerita',
            'totalPengumuman',
            'totalPendaftar',
            'totalGaleri',
            'totalKontak',
            'totalWhatsapp',
            'totalProgramUnggulan',
            'totalEkstrakurikuler',
            'beritaTerbaru',
            'pendaftarTerbaru'
        ));
    }
}