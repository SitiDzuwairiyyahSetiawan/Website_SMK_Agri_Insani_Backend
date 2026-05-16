<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    public function index(Request $request)
    {
        $query = Ekstrakurikuler::orderBy('id', 'asc');

        if ($request->search) {
            $query->where('nama_ekstrakurikuler', 'like', '%' . $request->search . '%');
        }

        $ekstrakurikulers = $query->paginate(10);

        $totalEkstrakurikuler = Ekstrakurikuler::count();

        $ikonCount = Ekstrakurikuler::whereNotNull('ikon')->count();

        return view('admin.ekstrakurikuler.index', compact(
            'ekstrakurikulers',
            'totalEkstrakurikuler',
            'ikonCount'
        ));
    }

    public function create()
    {
        return view('admin.ekstrakurikuler.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ekstrakurikuler' => 'required|string|max:255|unique:ekstrakurikulers',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|string|max:10',
        ]);

        Ekstrakurikuler::create([
            'nama_ekstrakurikuler' => $request->nama_ekstrakurikuler,
            'deskripsi' => $request->deskripsi,
            'ikon' => $request->ikon,
        ]);

        return redirect()
            ->route('admin.ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan!');
    }

    public function show(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikuler.show', compact('ekstrakurikuler'));
    }

    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $request->validate([
            'nama_ekstrakurikuler' => 'required|string|max:255|unique:ekstrakurikulers,nama_ekstrakurikuler,' . $ekstrakurikuler->id,
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|string|max:10',
        ]);

        $ekstrakurikuler->update([
            'nama_ekstrakurikuler' => $request->nama_ekstrakurikuler,
            'deskripsi' => $request->deskripsi,
            'ikon' => $request->ikon,
        ]);

        return redirect()
            ->route('admin.ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui!');
    }

    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        $ekstrakurikuler->delete();

        return redirect()
            ->route('admin.ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil dihapus!');
    }
}