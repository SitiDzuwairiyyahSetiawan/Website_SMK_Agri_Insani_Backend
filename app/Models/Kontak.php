<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontaks';
    
    protected $fillable = [
        'nama_lengkap',
        'no_telepon',
        'topik_pertanyaan',
        'pesan',
        'status',
        'balasan_admin',
        'dibaca_pada',
    ];
}