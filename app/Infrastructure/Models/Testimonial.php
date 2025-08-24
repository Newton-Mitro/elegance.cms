<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'designation', 'message', 'photo_id'];

    public function photo()
    {
        return $this->belongsTo(Media::class, 'photo_id');
    }
}