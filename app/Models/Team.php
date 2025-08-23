<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'designation', 'bio', 'photo_id', 'sort_order'];

    public function photo()
    {
        return $this->belongsTo(Media::class, 'photo_id');
    }
}