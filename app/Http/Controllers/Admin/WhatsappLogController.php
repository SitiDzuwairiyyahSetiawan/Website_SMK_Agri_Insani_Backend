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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $log = WhatsappLog::findOrFail($id);

        // otomatis jadi dibaca
        if ($log->status == 'pending') {

            $log->update([
                'status' => 'dibaca'
            ]);
        }

        return view('admin.whatsapp.show', compact('log'));
    }

    /**
     * Update status WhatsApp
     */
    public function updateStatus(Request $request, string $id)
    {
        $log = WhatsappLog::findOrFail($id);

        // otomatis jadi dibalas
        $log->update([
            'status' => 'dibalas'
        ]);

        return response()->json([
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