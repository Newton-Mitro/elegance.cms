<?php

namespace App\Infrastructure\Models;

use Database\Factories\PageSectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'content_type', 'content', 'sort_order'];

    protected $casts = [
        'content' => 'array',
        'gallery' => 'array',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    protected static function newFactory()
    {
        return PageSectionFactory::new();
    }
}
