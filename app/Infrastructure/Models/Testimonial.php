<?php

namespace App\Infrastructure\Models;

use Database\Factories\TestimonialFactory;
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

    protected static function newFactory()
    {
        return TestimonialFactory::new();
    }
}
