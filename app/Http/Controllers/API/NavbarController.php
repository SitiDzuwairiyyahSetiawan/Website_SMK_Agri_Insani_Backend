<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Navbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NavbarController extends Controller
{
    // Public: menampilkan semua navbar yang aktif (untuk frontend)
    public function index()
    {
        $navbars = Navbar::where('is_active', true)->orderBy('urutan')->get();
        return response()->json($navbars);
    }

    // Admin: menyimpan navbar baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_menu' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $navbar = Navbar::create($request->all());
        return response()->json($navbar, 201);
    }

    // Public: menampilkan satu navbar (jarang dipakai, tapi tetap)
    public function show($id)
    {
        $navbar = Navbar::findOrFail($id);
        return response()->json($navbar);
    }

    // Admin: update navbar
    public function update(Request $request, $id)
    {
        $navbar = Navbar::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_menu' => 'sometimes|string|max:255',
            'url' => 'sometimes|string|max:255',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $navbar->update($request->all());
        return response()->json($navbar);
    }

    // Admin: hapus navbar
    public function destroy($id)
    {
        $navbar = Navbar::findOrFail($id);
        $navbar->delete();
        return response()->json(['message' => 'Navbar deleted successfully']);
    }
}