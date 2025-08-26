<?php

namespace App\Infrastructure\Models;

use Database\Factories\AwardFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'date', 'media_id'];

    public function image()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    protected static function newFactory()
    {
        return AwardFactory::new();
    }
}
