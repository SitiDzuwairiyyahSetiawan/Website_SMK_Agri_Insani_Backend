<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:20',
                'topik_pertanyaan' => 'required|string|max:100',
                'pesan' => 'required|string',
            ]);

            // Format nomor telepon untuk WhatsApp (hapus 0 di awal, tambah 62)
            $wa_number = $this->formatWhatsAppNumber($validated['no_telepon']);
            $validated['no_telepon'] = $wa_number;

            $kontak = Kontak::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim, kami akan membalas via WhatsApp',
                'data' => $kontak
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim pesan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function formatWhatsAppNumber($phone)
    {
        // Hapus semua karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Jika dimulai dengan 0, ganti dengan 62
        if (substr($phone, 0, 1) == '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        // Jika dimulai dengan 8, tambah 62
        if (substr($phone, 0, 1) == '8') {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kontaks = Kontak::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $kontaks
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $kontak = Kontak::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $kontak
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $kontak = Kontak::findOrFail($id);
            
            $validated = $request->validate([
                'nama_lengkap' => 'sometimes|string|max:255',
                'no_telepon' => 'sometimes|string|max:20',
                'topik_pertanyaan' => 'sometimes|string|max:100',
                'pesan' => 'sometimes|string',
                'status' => 'sometimes|in:pending,dibaca,dibalas',
                'balasan_admin' => 'nullable|string',
            ]);

            $kontak->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $kontak
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kontak = Kontak::findOrFail($id);
            $kontak->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data'
            ], 500);
        }
    }

    /**
     * Update status kontak (pending/dibaca/dibalas)
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,dibaca,dibalas'
            ]);

            $kontak = Kontak::findOrFail($id);
            $kontak->update([
                'status' => $request->status,
                'dibaca_pada' => $request->status == 'dibaca' ? now() : $kontak->dibaca_pada
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate',
                'data' => $kontak
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status'
            ], 500);
        }
    }

    /**
     * Get admin WhatsApp configuration for frontend
     */
    public function getAdminWhatsapp()
    {
        return response()->json([
            'whatsapp' => env('ADMIN_WHATSAPP', '6281315065766')
        ]);
    }
}