<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->paginate(12);

        return response()->json([
            'success' => true,
            'data' => $galeri
        ]);
    }

    public function show($id)
    {
        $galeri = Galeri::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $galeri
        ]);
    }
}