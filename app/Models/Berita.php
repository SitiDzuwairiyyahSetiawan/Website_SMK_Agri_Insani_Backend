<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'judul', 
        'slug', 
        'konten', 
        'gambar', 
        'tanggal', 
        'is_published'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_published' => 'boolean'
    ];

    protected $appends = ['formatted_date'];
    
    public function getFormattedDateAttribute()
    {
        return $this->tanggal->format('d F Y');
    }

    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }
}