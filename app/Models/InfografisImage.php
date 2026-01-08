<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfografisImage extends Model
{
    use HasFactory;

    protected $table = 'infografis_images';

    protected $fillable = [
        'infografis_id',
        'image_path',
        'caption',
        'urutan',
    ];

    /**
     * Relasi:
     * Gambar milik satu infografis
     */
    public function infografis()
    {
        return $this->belongsTo(Infografis::class, 'infografis_id');
    }
}
