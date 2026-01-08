<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografis extends Model
{
    use HasFactory;

    protected $table = 'infografis';

    protected $fillable = [
        'judul',
        'deskripsi',
        'status',
        'published_at',
    ];

    /**
     * Relasi:
     * 1 Infografis memiliki banyak gambar
     */
    public function images()
    {
        return $this->hasMany(InfografisImage::class, 'infografis_id')
                    ->orderBy('urutan', 'asc');
    }
}
