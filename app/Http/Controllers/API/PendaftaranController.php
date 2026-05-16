<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display listing
     */
    public function index()
    {
        return response()->json(
            Pendaftaran::latest()->paginate(20)
        );
    }

    /**
     * Store new pendaftaran
     */
    public function store(Request $request)
    {
        try {

            // =========================
            // VALIDATION
            // =========================
            $request->validate([
                'nama_lengkap' => 'required|string|max:255',

                'nisn' => 'required|string|max:50|unique:pendaftarans,nisn',

                'nik' => 'nullable|string|max:50',

                'tempat_lahir' => 'required|string|max:255',

                'tanggal_lahir' => 'required|date',

                // FIX ENUM
                'jenis_kelamin' => 'required|in:L,P',

                'no_hp' => 'required|string|max:20|unique:pendaftarans,no_hp',

                'email' => 'required|email|max:255|unique:pendaftarans,email',

                'asal_sekolah' => 'required|string|max:255',

                'alamat' => 'required|string',

                'program_unggulan_id' => 'required|exists:program_unggulans,id',

                // OPTIONAL
                'nama_ayah' => 'nullable|string|max:255',
                'nama_ibu' => 'nullable|string|max:255',
                'no_hp_wali' => 'nullable|string|max:20',

                // FILES
                'foto_siswa' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

                'file_kk' => 'nullable|mimes:pdf,jpg,jpeg,png|max:4096',

                'transkrip_nilai' => 'nullable|mimes:pdf,jpg,jpeg,png|max:4096',
            ]);

            // =========================
            // UPLOAD FILE
            // =========================
            $foto = null;
            $kk = null;
            $transkrip = null;

            if ($request->hasFile('foto_siswa')) {
                $foto = $request->file('foto_siswa')
                    ->store('pendaftaran/foto', 'public');
            }

            if ($request->hasFile('file_kk')) {
                $kk = $request->file('file_kk')
                    ->store('pendaftaran/kk', 'public');
            }

            if ($request->hasFile('transkrip_nilai')) {
                $transkrip = $request->file('transkrip_nilai')
                    ->store('pendaftaran/transkrip', 'public');
            }

            // =========================
            // SAVE DATA
            // =========================
            $pendaftaran = Pendaftaran::create([

                'nama_lengkap' => $request->nama_lengkap,
                'nisn' => $request->nisn,
                'nik' => $request->nik,

                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,

                'alamat' => $request->alamat,

                'no_hp' => $request->no_hp,
                'email' => $request->email,

                'asal_sekolah' => $request->asal_sekolah,

                'program_unggulan_id' => $request->program_unggulan_id,

                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'no_hp_wali' => $request->no_hp_wali,

                'foto_siswa' => $foto,
                'file_kk' => $kk,
                'transkrip_nilai' => $transkrip,

                'status' => 'pending',
            ]);

            // =========================
            // RESPONSE SUCCESS
            // =========================
            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil dikirim',
                'data' => $pendaftaran
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {

            // VALIDATION ERROR
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {

            // SERVER ERROR
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show detail
     */
    public function show($id)
    {
        try {

            $data = Pendaftaran::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update pendaftaran
     */
    public function update(Request $request, $id)
    {
        try {

            $data = Pendaftaran::findOrFail($id);

            $request->validate([
                'status' => 'required|in:pending,dibaca,diverifikasi,lolos_berkas,diterima,ditolak',
                'catatan_admin' => 'nullable|string',
            ]);

            $data->update([
                'status' => $request->status,
                'catatan_admin' => $request->catatan_admin,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui',
                'data' => $data
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal update data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete data
     */
    public function destroy($id)
    {
        try {

            $data = Pendaftaran::findOrFail($id);

            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}