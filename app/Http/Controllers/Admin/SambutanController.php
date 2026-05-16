<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sambutan;
use Illuminate\Support\Facades\Storage;

class SambutanController extends Controller
{
    public function index()
    {
        $sambutans = Sambutan::oldest()->get();

        return view('admin.sambutan.index', compact('sambutans'));
    }

    public function create()
    {
        return view('admin.sambutan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kepala_sekolah' => 'required',
            'jabatan' => 'required',
            'pesan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['foto']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('sambutan', 'public');
        }

        Sambutan::create($data);

        return redirect()
            ->route('admin.sambutan.index')
            ->with('success', 'Data Sambutan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $sambutan = Sambutan::findOrFail($id);

        return view('admin.sambutan.show', compact('sambutan'));
    }

    public function edit($id)
    {
        $sambutan = Sambutan::findOrFail($id);

        return view('admin.sambutan.edit', compact('sambutan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kepala_sekolah' => 'required',
            'jabatan' => 'required',
            'pesan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $sambutan = Sambutan::findOrFail($id);

        $data = $request->except(['foto']);

        if ($request->hasFile('foto')) {

            if ($sambutan->foto && Storage::disk('public')->exists($sambutan->foto)) {
                Storage::disk('public')->delete($sambutan->foto);
            }

            $data['foto'] = $request->file('foto')->store('sambutan', 'public');
        }

        $sambutan->update($data);

        return redirect()
            ->route('admin.sambutan.index')
            ->with('success', 'Data Sambutan berhasil diupdate.');
    }

    public function delete($id)
    {
        $sambutan = Sambutan::findOrFail($id);

        return view('admin.sambutan.delete', compact('sambutan'));
    }

    public function destroy($id)
    {
        $sambutan = Sambutan::findOrFail($id);

        if ($sambutan->foto && Storage::disk('public')->exists($sambutan->foto)) {
            Storage::disk('public')->delete($sambutan->foto);
        }

        $sambutan->delete();

        return redirect()
            ->route('admin.sambutan.index')
            ->with('success', 'Data Sambutan berhasil dihapus.');
    }
}