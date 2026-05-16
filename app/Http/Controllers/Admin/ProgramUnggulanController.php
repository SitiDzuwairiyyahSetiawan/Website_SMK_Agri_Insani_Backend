<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramUnggulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramUnggulanController extends Controller
{
    public function index(Request $request)
    {
        $query = ProgramUnggulan::orderBy('id', 'asc');

        if ($request->search) {
            $query->where('nama_program_unggulan', 'like', '%' . $request->search . '%');
        }

        $programUnggulans = $query->paginate(10);

        $totalProgramUnggulan = ProgramUnggulan::count();

        $ikonCount = ProgramUnggulan::whereNotNull('ikon')->count();

        return view('admin.program-unggulan.index', compact(
            'programUnggulans',
            'totalProgramUnggulan',
            'ikonCount'
        ));
    }

    public function create()
    {
        return view('admin.program-unggulan.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'nama_program_unggulan' => 'required|string|max:255|unique:program_unggulans',

            'deskripsi' => 'required|string',

            'ikon' => 'required|string|max:100',

        ]);

        $data = $request->all();

        ProgramUnggulan::create($data);

        return redirect()
            ->route('admin.program-unggulan.index')
            ->with('success', 'Program unggulan berhasil ditambahkan!');
    }

    public function show(ProgramUnggulan $programUnggulan)
    {
        return view('admin.program-unggulan.show', compact('programUnggulan'));
    }

    public function edit(ProgramUnggulan $programUnggulan)
    {
        return view('admin.program-unggulan.edit', compact('programUnggulan'));
    }

    public function update(Request $request, ProgramUnggulan $programUnggulan)
    {
        $request->validate([

            'nama_program_unggulan' =>
                'required|string|max:255|unique:program_unggulans,nama_program_unggulan,' . $programUnggulan->id,

            'deskripsi' => 'required|string',

            'ikon' => 'required|string|max:100',

        ]);

        $data = $request->all();

        $programUnggulan->update($data);

        return redirect()
            ->route('admin.program-unggulan.index')
            ->with('success', 'Program unggulan berhasil diperbarui!');
    }

    public function destroy(ProgramUnggulan $programUnggulan)
    {

        $programUnggulan->delete();

        return redirect()
            ->route('admin.program-unggulan.index')
            ->with('success', 'Program unggulan berhasil dihapus!');
    }
}