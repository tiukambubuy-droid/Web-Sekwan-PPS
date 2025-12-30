<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function beritas()
    {
        return $this->belongsToMany(
            Berita::class,
            'news_tag',
            'tag_id',
            'news_id'
        );
    }
}
