<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'description'];

    public function media()
    {
        return $this->belongsToMany(Media::class, 'gallery_media');
    }
}