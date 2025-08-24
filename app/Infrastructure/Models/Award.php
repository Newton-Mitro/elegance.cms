<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'date', 'image_id'];

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }
}