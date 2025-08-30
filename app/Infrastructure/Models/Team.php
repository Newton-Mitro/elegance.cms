<?php

namespace App\Infrastructure\Models;

use Database\Factories\TeamFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'designation', 'bio', 'photo_id', 'sort_order'];
    protected $casts = [
        'content' => 'array',
        'gallery' => 'array',
    ];

    public function photo()
    {
        return $this->belongsTo(Media::class, 'photo_id');
    }

    protected static function newFactory()
    {
        return TeamFactory::new();
    }
}
