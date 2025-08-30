<?php

namespace App\Infrastructure\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'thumbnail_id', 'status'];
    protected $casts = [
        'content' => 'array',
        'gallery' => 'array',
    ];

    public function thumbnail()
    {
        return $this->belongsTo(Media::class, 'thumbnail_id');
    }

    protected static function newFactory()
    {
        return ProjectFactory::new();
    }
}
