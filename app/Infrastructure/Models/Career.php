<?php

namespace App\Infrastructure\Models;

use Database\Factories\CareerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'location', 'deadline', 'status'];

    protected static function newFactory()
    {
        return CareerFactory::new();
    }
}
