<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SejarahController extends Controller
{
    /**
     * Menampilkan daftar sejarah (bisa multi-record).
     */
    public function index(Request $request)
    {
        $query = Sejarah::query();

        if ($request->filled('search')) {
            $query->where('konten', 'like', '%' . $request->search . '%');
        }

        // Urutkan berdasarkan terbaru
        $sejarahs = $query->oldest()->paginate(10);

        $totalSejarah = Sejarah::count();

        return view('admin.sejarah.index', compact('sejarahs', 'totalSejarah'));
    }

    /**
     * Form tambah sejarah.
     */
    public function create()
    {
        return view('admin.sejarah.create');
    }

    /**
     * Simpan data sejarah baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('sejarah', 'public');
        }

        Sejarah::create([
            'konten' => $request->konten,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.sejarah.index')
            ->with('success', 'Sejarah berhasil ditambahkan!');
    }

    /**
     * Detail sejarah.
     */
    public function show($id)
    {
        $sejarah = Sejarah::findOrFail($id);
        return view('admin.sejarah.show', compact('sejarah'));
    }

    /**
     * Form edit sejarah.
     */
    public function edit($id)
    {
        $sejarah = Sejarah::findOrFail($id);
        return view('admin.sejarah.edit', compact('sejarah'));
    }

    /**
     * Update data sejarah.
     */
    public function update(Request $request, $id)
    {
        $sejarah = Sejarah::findOrFail($id);

        $request->validate([
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = ['konten' => $request->konten];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($sejarah->gambar && Storage::disk('public')->exists($sejarah->gambar)) {
                Storage::disk('public')->delete($sejarah->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('sejarah', 'public');
        }

        $sejarah->update($data);

        return redirect()->route('admin.sejarah.index')
            ->with('success', 'Sejarah berhasil diperbarui!');
    }

    /**
     * Hapus data sejarah.
     */
    public function destroy($id)
    {
        try {
            $sejarah = Sejarah::findOrFail($id);
            if ($sejarah->gambar && Storage::disk('public')->exists($sejarah->gambar)) {
                Storage::disk('public')->delete($sejarah->gambar);
            }
            $sejarah->delete();
            return redirect()->route('admin.sejarah.index')
                ->with('success', 'Sejarah berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.sejarah.index')
                ->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    /**
 * Menampilkan halaman konfirmasi hapus.
 */
    public function confirmDelete($id)
    {
        $sejarah = Sejarah::findOrFail($id);
        return view('admin.sejarah.delete', compact('sejarah'));
    }
}