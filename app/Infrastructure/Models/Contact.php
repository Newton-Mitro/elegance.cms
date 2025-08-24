<?php

namespace App\Infrastructure\Models;

use Database\Factories\ContactFactory;
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

    protected static function newFactory()
    {
        return ContactFactory::new();
    }
}
