<?php

namespace App\Http\Controllers\API\Publikasi;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::published()->latest('tanggal')->paginate(10);
        
        // Tambahkan file_url ke response
        $pengumuman->getCollection()->transform(function($item) {
            $item->file_url = $item->file_url; // panggil accessor
            return $item;
        });
        
        return response()->json($pengumuman);
    }

    public function show($slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)->published()->firstOrFail();
        
        // Tambahkan file_url ke response
        $pengumuman->file_url = $pengumuman->file_url;
        
        return response()->json($pengumuman);
    }
}