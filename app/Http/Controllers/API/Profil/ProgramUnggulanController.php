<?php

namespace App\Http\Controllers\API\Profil;

use App\Http\Controllers\Controller;
use App\Models\ProgramUnggulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramUnggulanController extends Controller
{
    public function index()
    {
        return response()->json(ProgramUnggulan::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_program_unggulan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|string|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $programUnggulan = ProgramUnggulan::create($request->all());
        return response()->json($programUnggulan, 201);
    }

    public function show($id)
    {
        return response()->json(ProgramUnggulan::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $programUnggulan = ProgramUnggulan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama_program_unggulan' => 'sometimes|string|max:255',
            'deskripsi' => 'sometimes|string',
            'ikon' => 'nullable|string|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $programUnggulan->update($request->all());
        return response()->json($programUnggulan);
    }

    public function destroy($id)
    {
        ProgramUnggulan::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}