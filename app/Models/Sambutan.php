<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sambutan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kepala_sekolah',
        'jabatan',
        'foto',
        'pesan',
    ];
}
