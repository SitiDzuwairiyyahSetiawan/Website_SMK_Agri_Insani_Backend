<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Tampilkan semua pesan kontak
     */
    public function index()
    {
        $kontaks = Kontak::orderBy('id', 'asc')->paginate(10);

        $statistik = [
            'total'   => Kontak::count(),
            'pending' => Kontak::where('status', 'pending')->count(),
            'dibaca'  => Kontak::where('status', 'dibaca')->count(),
            'dibalas' => Kontak::where('status', 'dibalas')->count(),
        ];

        return view('admin.kontak.index', compact('kontaks', 'statistik'));
    }

    /**
     * Detail pesan
     */
    public function show($id)
    {
        $kontak = Kontak::findOrFail($id);

        // otomatis tandai dibaca
        if ($kontak->status == 'pending') {
            $kontak->update([
                'status'      => 'dibaca',
                'dibaca_pada' => now(),
            ]);
        }

        return view('admin.kontak.show', compact('kontak'));
    }

    /**
     * Tandai pesan dibaca
     */
    public function tandaiDibaca($id)
    {
        $kontak = Kontak::findOrFail($id);

        $kontak->update([
            'status'      => 'dibaca',
            'dibaca_pada' => now(),
        ]);

        return redirect()
            ->route('admin.kontak.index')
            ->with('success', 'Pesan berhasil ditandai sebagai dibaca');
    }

    /**
     * Form konfirmasi hapus
     */
    public function confirmDelete($id)
    {
        $kontak = Kontak::findOrFail($id);

        return view('admin.kontak.delete', compact('kontak'));
    }

    /**
     * Hapus pesan
     */
    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);

        $kontak->delete();

        return redirect()
            ->route('admin.kontak.index')
            ->with('success', 'Pesan berhasil dihapus');
    }

    /**
     * Balas pesan via WhatsApp
     */
    public function balas(Request $request, $id)
    {
        $request->validate([
            'balasan_admin' => 'required|string|min:3',
        ]);

        $kontak = Kontak::findOrFail($id);

        $kontak->update([
            'balasan_admin' => $request->balasan_admin,
            'status'        => 'dibalas',
        ]);

        $waUrl = $this->generateWhatsAppUrl($kontak);

        return redirect()
            ->route('admin.kontak.index')
            ->with([
                'success' => 'Balasan berhasil dikirim',
                'wa_url'  => $waUrl,
            ]);
    }

    /**
     * Simpan balasan via AJAX
     */
    public function saveBalasan(Request $request)
    {
        $request->validate([
            'kontak_id' => 'required',
            'balasan'   => 'required|string',
        ]);

        $kontak = Kontak::findOrFail($request->kontak_id);

        $kontak->update([
            'balasan_admin' => $request->balasan,
            'status'        => 'dibalas',
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Generate URL WhatsApp
     */
    private function generateWhatsAppUrl($kontak)
    {
        $phone = $kontak->no_telepon;

        $message = "*SMK Agri Insani*\n\n";
        $message .= "Halo *{$kontak->nama_lengkap}*,\n\n";
        $message .= "Terima kasih telah menghubungi kami.\n\n";
        $message .= "📝 *Topik:* {$kontak->topik_pertanyaan}\n\n";
        $message .= "*Balasan:*\n";
        $message .= "{$kontak->balasan_admin}\n\n";
        $message .= "_SMK Agri Insani_";

        $encodedMessage = urlencode($message);

        return "https://wa.me/{$phone}?text={$encodedMessage}";
    }

    /**
     * Export data kontak
     */
    public function export()
    {
        $kontaks = Kontak::all();

        return response()->json([
            'success' => true,
            'data'    => $kontaks,
        ]);
    }
}