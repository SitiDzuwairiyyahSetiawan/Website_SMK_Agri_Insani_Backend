<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsappLog;
use Illuminate\Http\Request;

class WhatsappLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // terbaru di atas
        $whatsappLogs = WhatsappLog::orderBy('id', 'asc')->paginate(10);

        $statistik = [
            'total'   => WhatsappLog::count(),
            'pending' => WhatsappLog::where('status', 'pending')->count(),
            'dibaca'  => WhatsappLog::where('status', 'dibaca')->count(),
            'dibalas' => WhatsappLog::where('status', 'dibalas')->count(),
        ];

        return view('admin.whatsapp.index', compact(
            'whatsappLogs',
            'statistik'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $log = WhatsappLog::findOrFail($id);

        // otomatis jadi dibaca
        if ($log->status === 'pending') {

            $log->update([
                'status' => 'dibaca'
            ]);

            // refresh data terbaru
            $log->refresh();
        }

        return view('admin.whatsapp.show', compact('log'));
    }

    /**
     * Update status WhatsApp
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,dibaca,dibalas'
        ]);

        $log = WhatsappLog::findOrFail($id);

        $log->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $log = WhatsappLog::findOrFail($id);

        $log->delete();

        return redirect()
            ->route('admin.whatsapp-logs.index')
            ->with('success', 'Log berhasil dihapus');
    }
}