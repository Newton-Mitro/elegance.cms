<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
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