<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumumanImage extends Model
{
    protected $table = 'pengumuman_images';

    protected $fillable = [
        'pengumuman_id',
        'image_path',
    ];

    public function pengumuman()
    {
        return $this->belongsTo(Pengumuman::class);
    }
}
