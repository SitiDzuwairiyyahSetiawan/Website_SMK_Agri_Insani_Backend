<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumans';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'file_path',
        'tanggal',
        'is_published'
    ];

    protected $casts = [
    'tanggal' => 'date',
    'is_published' => 'boolean'
    ];

    protected $appends = ['formatted_date'];

    // Accessor for formatted date (contoh: 01 Januari 2025)
    public function getFormattedDateAttribute()
    {
        return $this->tanggal->format('d F Y');
    }

    // Helper untuk mendapatkan URL file (jika ada)
    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    // Helper untuk mendapatkan tipe file (image atau document)
    public function getFileTypeAttribute()
    {
        if (!$this->file_path) return null;
        $extension = strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION));
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            return 'image';
        }
        return 'document';
    }

    // Scope untuk pengumuman yang dipublikasikan
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope untuk draft
    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }
}