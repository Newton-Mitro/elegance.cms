<?php

namespace App\Infrastructure\Models;

use Database\Factories\PageSectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'heading',
        'sub_heading',
        'button_text',
        'button_link',
        'content',
        'gallery',
        'media_id',
        'content_type',
        'sort_order',
    ];


    protected $casts = [
        'content' => 'array',
        'gallery' => 'array',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    protected static function newFactory()
    {
        return PageSectionFactory::new();
    }
}
