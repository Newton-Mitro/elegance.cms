<?php

namespace App\Infrastructure\Models;

use Database\Factories\ContactMessageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'message'];

    protected static function newFactory()
    {
        return ContactMessageFactory::new();
    }
}
