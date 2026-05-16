<?php

namespace App\Http\Controllers\API\Profil;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        return response()->json(
            Ekstrakurikuler::orderBy('id', 'asc')->get()
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ekstrakurikuler' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $ekskul = Ekstrakurikuler::create($request->all());

        return response()->json($ekskul, 201);
    }

    public function show($id)
    {
        return response()->json(
            Ekstrakurikuler::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_ekstrakurikuler' => 'sometimes|string|max:255',
            'deskripsi' => 'sometimes|string',
            'ikon' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $ekskul->update($request->all());

        return response()->json($ekskul);
    }

    public function destroy($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);

        $ekskul->delete();

        return response()->json([
            'message' => 'Ekstrakurikuler berhasil dihapus'
        ]);
    }
}