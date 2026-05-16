<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visi = VisiMisi::where('type', 'visi')
            ->oldest()
            ->first();

        $misis = VisiMisi::where('type', 'misi')
            ->oldest()
            ->get();

        $visimisis = VisiMisi::oldest()
            ->paginate(10);

        // ✅ TAMBAHAN INI
        $totalVisi = VisiMisi::where('type', 'visi')->count();
        $totalMisi = VisiMisi::where('type', 'misi')->count();

        return view('admin.visi-misi.index', compact(
            'visi',
            'misis',
            'visimisis',
            'totalVisi',
            'totalMisi'
        ));
    }

    public function create($type)
    {
        return view('admin.visi-misi.create', compact('type'));
    }

    public function store(Request $request)
    {
        if ($request->type == 'visi') {

            $request->validate([
                'visi' => 'required|string'
            ]);

            VisiMisi::create([
                'type' => 'visi',
                'visi' => $request->visi
            ]);

        } else {

            $request->validate([
                'misi' => 'required|array',
                'misi.*' => 'required|string'
            ]);

            foreach ($request->misi as $item) {

                VisiMisi::create([
                    'type' => 'misi',
                    'misi' => $item
                ]);
            }
        }

        return redirect()
            ->route('admin.visi-misi.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $visiMisi = VisiMisi::findOrFail($id);

        return view('admin.visi-misi.show', compact('visiMisi'));
    }

    public function edit($id)
    {
        $visiMisi = VisiMisi::findOrFail($id);

        return view('admin.visi-misi.edit', compact('visiMisi'));
    }

    public function update(Request $request, $id)
    {
        $visiMisi = VisiMisi::findOrFail($id);

        if ($visiMisi->type == 'visi') {

            $request->validate([
                'visi' => 'required|string'
            ]);

            $visiMisi->update([
                'visi' => $request->visi
            ]);

        } else {

            $request->validate([
                'misi' => 'required|string'
            ]);

            $visiMisi->update([
                'misi' => $request->misi
            ]);
        }

        return redirect()
            ->route('admin.visi-misi.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $visiMisi = VisiMisi::findOrFail($id);

        $visiMisi->delete();

        return redirect()
            ->route('admin.visi-misi.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function confirmDelete($id)
    {
        $visiMisi = VisiMisi::findOrFail($id);

        return view('admin.visi-misi.delete', compact('visiMisi'));
    }
}