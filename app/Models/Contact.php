<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'address',
        'phone',
        'email',
        'map_embed',
        'opening_hours',
        'latitude',
        'longitude',
    ];
}