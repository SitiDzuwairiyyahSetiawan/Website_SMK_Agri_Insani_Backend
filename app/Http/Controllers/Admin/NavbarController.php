<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Navbar;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    public function index()
    {
        $navbars = Navbar::orderBy('urutan')->get();
        return view('admin.navbar.index', compact('navbars'));
    }

    public function create()
    {
        return view('admin.navbar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'url' => 'required|string|max:200',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);
        Navbar::create([
            'nama_menu' => $request->nama_menu,
            'url' => $request->url,
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.navbar.index')->with('success', 'Menu ditambahkan.');
    }

    public function edit(Navbar $navbar)
    {
        return view('admin.navbar.edit', compact('navbar'));
    }

    public function update(Request $request, Navbar $navbar)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'url' => 'required|string|max:200',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);
        $navbar->update([
            'nama_menu' => $request->nama_menu,
            'url' => $request->url,
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.navbar.index')->with('success', 'Menu diupdate.');
    }

    public function destroy(Navbar $navbar)
    {
        $navbar->delete();
        return redirect()->route('admin.navbar.index')->with('success', 'Menu dihapus.');
    }
}