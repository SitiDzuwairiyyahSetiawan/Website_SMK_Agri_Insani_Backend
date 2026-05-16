<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WhatsappLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WhatsappLogController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'purpose' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $log = WhatsappLog::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'purpose' => $request->purpose,
              'status' => $request->status ?? 'Tertunda',
        ]);

        return response()->json($log, 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $log = WhatsappLog::findOrFail($id);
        $log->update(['status' => 'terkirim']);
        return response()->json($log);
    }
}
