<?php

namespace App\Http\Controllers\API\Profil;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SejarahController extends Controller
{
    /**
     * GET /api/profil/sejarah
     * Menampilkan daftar sejarah dengan pagination dan search.
     */
    public function index(Request $request)
    {
        $query = Sejarah::query();

        // Filter pencarian berdasarkan konten
        if ($request->filled('search')) {
            $query->where('konten', 'like', '%' . $request->search . '%');
        }

        // Pagination (default 10 per halaman)
        $perPage = $request->input('per_page', 10);
        $sejarahs = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $sejarahs->map(function ($item) {
                return [
                    'id'         => $item->id,
                    'konten'     => $item->konten,
                    'gambar_url' => $item->gambar_url,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            }),
            'pagination' => [
                'total'        => $sejarahs->total(),
                'per_page'     => $sejarahs->perPage(),
                'current_page' => $sejarahs->currentPage(),
                'last_page'    => $sejarahs->lastPage(),
                'from'         => $sejarahs->firstItem(),
                'to'           => $sejarahs->lastItem(),
            ]
        ]);
    }

    /**
     * GET /api/profil/sejarah/{id}
     * Menampilkan satu data sejarah.
     */
    public function show($id)
    {
        $sejarah = Sejarah::find($id);
        if (!$sejarah) {
            return response()->json([
                'success' => false,
                'message' => 'Sejarah tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id'         => $sejarah->id,
                'konten'     => $sejarah->konten,
                'gambar_url' => $sejarah->gambar_url,
                'created_at' => $sejarah->created_at,
                'updated_at' => $sejarah->updated_at,
            ]
        ]);
    }

    /**
     * POST /api/profil/sejarah
     * Menyimpan data sejarah baru.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'konten' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->only('konten');

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('sejarah', 'public');
                $data['gambar'] = $path;
            }

            $sejarah = Sejarah::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Sejarah berhasil ditambahkan.',
                'data' => [
                    'id'         => $sejarah->id,
                    'konten'     => $sejarah->konten,
                    'gambar_url' => $sejarah->gambar_url,
                ]
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * PUT/PATCH /api/profil/sejarah/{id}
     * Memperbarui data sejarah.
     */
    public function update(Request $request, $id)
    {
        $sejarah = Sejarah::find($id);
        if (!$sejarah) {
            return response()->json([
                'success' => false,
                'message' => 'Sejarah tidak ditemukan.'
            ], 404);
        }

        try {
            $request->validate([
                'konten' => 'sometimes|required|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->only('konten');

            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($sejarah->gambar && Storage::disk('public')->exists($sejarah->gambar)) {
                    Storage::disk('public')->delete($sejarah->gambar);
                }
                $path = $request->file('gambar')->store('sejarah', 'public');
                $data['gambar'] = $path;
            }

            $sejarah->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Sejarah berhasil diperbarui.',
                'data' => [
                    'id'         => $sejarah->id,
                    'konten'     => $sejarah->konten,
                    'gambar_url' => $sejarah->gambar_url,
                ]
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * DELETE /api/profil/sejarah/{id}
     * Menghapus data sejarah.
     */
    public function destroy($id)
    {
        $sejarah = Sejarah::find($id);
        if (!$sejarah) {
            return response()->json([
                'success' => false,
                'message' => 'Sejarah tidak ditemukan.'
            ], 404);
        }

        // Hapus file gambar
        if ($sejarah->gambar && Storage::disk('public')->exists($sejarah->gambar)) {
            Storage::disk('public')->delete($sejarah->gambar);
        }

        $sejarah->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sejarah berhasil dihapus.'
        ]);
    }
}