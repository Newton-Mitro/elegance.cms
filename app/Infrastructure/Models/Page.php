<?php

namespace App\Infrastructure\Models;

use Database\Factories\PageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'meta_title', 'meta_description', 'status', 'media_id'];

    public function sections()
    {
        return $this->hasMany(PageSection::class);
    }




    protected static function newFactory()
    {
        return PageFactory::new();
    }
}
