<?php

namespace App\Infrastructure\Models;

use Database\Factories\MediaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'file_path', 'file_type', 'alt_text', 'caption'];

    public function sections()
    {
        return $this->morphedByMany(PageSection::class, 'mediaable');
    }

    protected static function newFactory()
    {
        return MediaFactory::new();
    }
}
