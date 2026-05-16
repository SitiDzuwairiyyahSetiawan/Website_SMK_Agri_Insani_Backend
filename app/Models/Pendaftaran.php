<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'nisn',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'email',
        'asal_sekolah',
        'program_unggulan_id',

        'nama_ayah',
        'nama_ibu',
        'no_hp_wali',

        'foto_siswa',
        'file_kk',
        'transkrip_nilai',

        'status',
        'catatan_admin',

        // tracking admin
        'verified_by',
        'verified_at',
    ];

    /**
     * RELASI KE PROGRAM UNGGULAN
     */
    public function program()
    {
        return $this->belongsTo(
            \App\Models\ProgramUnggulan::class,
            'program_unggulan_id'
        );
    }
}