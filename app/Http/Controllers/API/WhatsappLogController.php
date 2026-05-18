<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WhatsappLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WhatsappLogController extends Controller
{
    /**
     * Simpan log WhatsApp baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'purpose' => 'required|string|max:255',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $log = WhatsappLog::create([

            'name'    => $request->name,
            'phone'   => $request->phone,
            'purpose' => $request->purpose,

            // DEFAULT HARUS PENDING
            'status'  => 'pending',

        ]);

        return response()->json([
            'success' => true,
            'message' => 'WhatsApp log berhasil disimpan',
            'data'    => $log
        ], 201);
    }

    /**
     * Update status WhatsApp
     */
    public function updateStatus(Request $request, $id)
    {
        $log = WhatsappLog::findOrFail($id);

        $log->update([
            'status' => 'dibalas'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'data'    => $log
        ]);
    }
}