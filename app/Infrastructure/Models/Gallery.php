<?php

namespace App\Infrastructure\Models;

use Database\Factories\GalleryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function media()
    {
        return $this->belongsToMany(Media::class, 'gallery_media');
    }

    protected static function newFactory()
    {
        return GalleryFactory::new();
    }
}
