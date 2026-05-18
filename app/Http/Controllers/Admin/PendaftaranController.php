<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    /**
     * LIST DATA
     */
    public function index()
    {
        $pendaftarans = Pendaftaran::with('program')
            ->orderBy('id', 'asc')
            ->paginate(15);

        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    /**
     * DETAIL DATA
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::with('program')
            ->findOrFail($id);

        // otomatis ubah status ketika dibuka admin
        if ($pendaftaran->status === 'pending') {

            $pendaftaran->update([
                'status' => 'dibaca'
            ]);
        }

        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $pendaftaran = Pendaftaran::with('program')
            ->findOrFail($id);

        return view('admin.pendaftaran.edit', compact('pendaftaran'));
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,dibaca,diverifikasi,lolos_berkas,diterima,ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,

            // tracking admin
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        return redirect()
            ->route('admin.pendaftaran.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    /**
     * UPDATE STATUS CEPAT
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,dibaca,diverifikasi,lolos_berkas,diterima,ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,

            // tracking admin
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        return redirect()
            ->route('admin.pendaftaran.index')
            ->with('success', 'Status berhasil diperbarui');
    }

    /**
     * DELETE DATA
     */
    public function destroy($id)
    {
        $data = Pendaftaran::findOrFail($id);

        foreach ([
            $data->foto_siswa,
            $data->file_kk,
            $data->transkrip_nilai
        ] as $file) {

            if ($file && Storage::disk('public')->exists($file)) {

                Storage::disk('public')->delete($file);
            }
        }

        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    /**
     * DOWNLOAD FILE
     */
    public function download($id, $type)
    {
        $data = Pendaftaran::findOrFail($id);

        $file = match ($type) {

            'foto' => $data->foto_siswa,

            'kk' => $data->file_kk,

            'transkrip' => $data->transkrip_nilai,

            default => null
        };

        abort_if(!$file, 404);

        return Storage::disk('public')->download($file);
    }
}