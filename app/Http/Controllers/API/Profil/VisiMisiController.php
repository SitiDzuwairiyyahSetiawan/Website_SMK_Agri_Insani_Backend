<?php

namespace App\Http\Controllers\API\Profil;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisiMisiController extends Controller
{
    /**
     * Menampilkan data visi & misi
     */
    public function index()
    {
        $visi = VisiMisi::where('type', 'visi')
            ->latest()
            ->first();

        $misis = VisiMisi::where('type', 'misi')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data visi misi berhasil diambil',

            'data' => [
                'visi' => $visi,
                'misis' => $misis
            ]
        ]);
    }

    /**
     * Simpan data
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:visi,misi',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->type == 'visi') {

            $visiMisi = VisiMisi::create([
                'type' => 'visi',
                'visi' => $request->visi,
            ]);

        } else {

            $visiMisi = VisiMisi::create([
                'type' => 'misi',
                'misi' => $request->misi,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $visiMisi
        ], 201);
    }

    /**
     * Detail data
     */
    public function show($id)
    {
        $visiMisi = VisiMisi::find($id);

        if (!$visiMisi) {

            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $visiMisi
        ]);
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $visiMisi = VisiMisi::find($id);

        if (!$visiMisi) {

            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        if ($visiMisi->type == 'visi') {

            $validator = Validator::make($request->all(), [
                'visi' => 'required|string',
            ]);

        } else {

            $validator = Validator::make($request->all(), [
                'misi' => 'required|string',
            ]);
        }

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($visiMisi->type == 'visi') {

            $visiMisi->update([
                'visi' => $request->visi,
            ]);

        } else {

            $visiMisi->update([
                'misi' => $request->misi,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $visiMisi
        ]);
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $visiMisi = VisiMisi::find($id);

        if (!$visiMisi) {

            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $visiMisi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}