<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'description', 'icon_id', 'status'];

    public function icon()
    {
        return $this->belongsTo(Media::class, 'icon_id');
    }
}