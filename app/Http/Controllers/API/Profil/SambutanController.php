<?php

namespace App\Http\Controllers\API\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sambutan;

class SambutanController extends Controller
{
    public function index()
    {
        // Mengambil data sambutan yang paling terbaru (di case multiple sambutan history)
        $sambutan = Sambutan::latest()->first();
        
        if ($sambutan && $sambutan->foto) {
            $sambutan->foto = url('storage/' . $sambutan->foto);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Sambutan berhasil diambil.',
            'data'    => $sambutan,
        ]);
    }

    public function store(Request $request) { /* Optional if single */ }
    public function show($id) { /* Optional */ }
    public function update(Request $request, $id) { /* Optional */ }
    public function destroy($id) { /* Optional */ }
}
