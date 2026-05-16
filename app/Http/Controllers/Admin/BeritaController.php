<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('is_published', $request->status == 'published');
        }
        $beritas = $query->latest('tanggal')->paginate(10);
        $totalBerita = Berita::count();
        $publishedCount = Berita::where('is_published', true)->count();
        $draftCount = Berita::where('is_published', false)->count();
        return view('admin.berita.index', compact('beritas', 'totalBerita', 'publishedCount', 'draftCount'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'slug'         => 'nullable|string|unique:beritas,slug',
            'konten'       => 'required|string',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // hanya gambar
            'tanggal'      => 'required|date',
            'is_published' => 'required|boolean'
        ]);

        $slug = $request->slug ?: Str::slug($request->judul);
        $slug = $this->generateUniqueSlug($slug);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create([
            'judul'        => $request->judul,
            'slug'         => $slug,
            'konten'       => $request->konten,
            'gambar'       => $gambarPath,
            'tanggal'      => $request->tanggal,
            'is_published' => $request->is_published
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('admin.berita.show', compact('berita'));
    }

    public function edit($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $request->validate([
            'judul'        => 'required|string|max:255',
            'slug'         => 'nullable|string|unique:beritas,slug,' . $berita->id,
            'konten'       => 'required|string',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal'      => 'required|date',
            'is_published' => 'required|boolean'
        ]);

        $newSlug = $request->slug ?: Str::slug($request->judul);
        if ($newSlug != $berita->slug) {
            $newSlug = $this->generateUniqueSlug($newSlug, $berita->id);
        }

        $gambarPath = $berita->gambar;
        if ($request->hasFile('gambar')) {
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update([
            'judul'        => $request->judul,
            'slug'         => $newSlug,
            'konten'       => $request->konten,
            'gambar'       => $gambarPath,
            'tanggal'      => $request->tanggal,
            'is_published' => $request->is_published
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate!');
    }

    public function destroy($slug)
    {
        try {
            $berita = Berita::where('slug', $slug)->firstOrFail();
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $berita->delete();
            return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.berita.index')->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    public function publish($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $berita->update(['is_published' => true]);
        return redirect()->route('admin.berita.show', $berita->slug)->with('success', 'Berita dipublikasikan!');
    }

    private function generateUniqueSlug($slug, $ignoreId = null)
    {
        $original = $slug;
        $count = 1;
        while (Berita::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $original . '-' . $count++;
        }
        return $slug;
    }
}