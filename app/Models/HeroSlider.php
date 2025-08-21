<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    protected $fillable = ['title', 'subtitle', 'button_text', 'button_link', 'image_id', 'sort_order'];

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }
}