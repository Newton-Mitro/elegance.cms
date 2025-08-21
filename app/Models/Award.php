<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = ['title', 'description', 'date', 'image_id'];

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }
}