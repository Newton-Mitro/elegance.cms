<?php

namespace App\Infrastructure\Models;

use Database\Factories\NoticeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'status'];

    protected static function newFactory()
    {
        return NoticeFactory::new();
    }
}
