<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'author',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // 🔑 RELASI MANY TO MANY
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'news_tag',
            'news_id',
            'tag_id'
        );
    }
}
