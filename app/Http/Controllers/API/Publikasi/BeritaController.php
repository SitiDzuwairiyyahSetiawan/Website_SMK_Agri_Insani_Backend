<?php

namespace App\Http\Controllers\API\Publikasi;

use App\Http\Controllers\Controller;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::published()->latest('tanggal')->paginate(6);
        return response()->json($berita);
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->published()->firstOrFail();
        return response()->json($berita);
    }
}