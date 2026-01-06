<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Agenda extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'location',
        'latitude',
        'longitude',
        'status',
        'author'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];


    // auto slug
    protected static function booted()
    {
        static::creating(function ($agenda) {
            $agenda->slug = Str::slug($agenda->title);
        });
    }
}
