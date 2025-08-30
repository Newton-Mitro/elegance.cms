<?php

namespace App\Infrastructure\Models;

use Database\Factories\GalleryMediaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryMedia extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return GalleryMediaFactory::new();
    }
}
