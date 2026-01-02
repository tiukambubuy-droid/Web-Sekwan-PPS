<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'author',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // 🔗 1 Pengumuman punya banyak gambar
    public function images()
    {
        return $this->hasMany(PengumumanImage::class);
    }
}
