<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['menu_item_id', 'title', 'content'];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
