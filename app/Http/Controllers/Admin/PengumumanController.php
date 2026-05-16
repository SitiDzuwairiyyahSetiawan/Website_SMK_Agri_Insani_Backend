<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Menampilkan daftar pengumuman.
     */
    public function index(Request $request)
    {
        $query = Pengumuman::query();

        // Pencarian berdasarkan judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Filter status
        if ($request->filled('status')) {
            $isPublished = $request->status == 'published';
            $query->where('is_published', $isPublished);
        }

        $pengumumans = $query->latest('tanggal')->paginate(10);

        // Statistik
        $totalPengumuman = Pengumuman::count();
        $publishedCount = Pengumuman::where('is_published', true)->count();
        $draftCount = Pengumuman::where('is_published', false)->count();

        return view('admin.pengumuman.index', compact('pengumumans', 'totalPengumuman', 'publishedCount', 'draftCount'));
    }

    /**
     * Form tambah pengumuman.
     */
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    /**
     * Simpan pengumuman baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'slug'       => 'nullable|string|unique:pengumumans,slug',
            'isi'        => 'required|string',
            'file'       => 'nullable|file|max:5120', // maksimal 5MB, bisa diubah
            'tanggal'    => 'required|date',
            'is_published' => 'required|boolean',
        ]);

        // Slug otomatis jika kosong
        $slug = $request->slug ?: Str::slug($request->judul);
        $slug = $this->generateUniqueSlug($slug);

        // Upload file jika ada
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('pengumuman', 'public');
        }

        Pengumuman::create([
            'judul'       => $request->judul,
            'slug'        => $slug,
            'isi'         => $request->isi,
            'file_path'   => $filePath,
            'tanggal'     => $request->tanggal,
            'is_published'=> $request->is_published,
        ]);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    /**
     * Detail pengumuman.
     */
    public function show($slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    /**
     * Form edit pengumuman.
     */
    public function edit($slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update pengumuman.
     */
    public function update(Request $request, $slug)
    {
        $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();

        $request->validate([
            'judul'      => 'required|string|max:255',
            'slug'       => 'nullable|string|unique:pengumumans,slug,' . $pengumuman->id,
            'isi'        => 'required|string',
            'file'       => 'nullable|file|max:5120',
            'tanggal'    => 'required|date',
            'is_published'=> 'required|boolean',
        ]);

        // Slug
        $newSlug = $request->slug ?: Str::slug($request->judul);
        if ($newSlug != $pengumuman->slug) {
            $newSlug = $this->generateUniqueSlug($newSlug, $pengumuman->id);
        } else {
            $newSlug = $pengumuman->slug;
        }

        // File upload
        $filePath = $pengumuman->file_path;
        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('file')->store('pengumuman', 'public');
        }

        $pengumuman->update([
            'judul'       => $request->judul,
            'slug'        => $newSlug,
            'isi'         => $request->isi,
            'file_path'   => $filePath,
            'tanggal'     => $request->tanggal,
            'is_published'=> $request->is_published,
        ]);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diupdate!');
    }

    /**
     * Hapus pengumuman.
     */
    public function destroy($slug)
    {
        try {
            $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();

            // Hapus file jika ada
            if ($pengumuman->file_path && Storage::disk('public')->exists($pengumuman->file_path)) {
                Storage::disk('public')->delete($pengumuman->file_path);
            }

            $pengumuman->delete();

            return redirect()->route('admin.pengumuman.index')
                ->with('success', 'Pengumuman berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.pengumuman.index')
                ->with('error', 'Gagal menghapus pengumuman: ' . $e->getMessage());
        }
    }

    /**
     * Publikasikan pengumuman (ubah status menjadi published).
     */
    public function publish($slug)
    {
        try {
            $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();
            $pengumuman->update(['is_published' => true]);

            return redirect()->route('admin.pengumuman.show', $pengumuman->slug)
                ->with('success', 'Pengumuman berhasil dipublikasikan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mempublikasikan pengumuman: ' . $e->getMessage());
        }
    }

    /**
     * Generate slug unik.
     */
    private function generateUniqueSlug($slug, $ignoreId = null)
    {
        $originalSlug = $slug;
        $counter = 1;

        while (Pengumuman::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}