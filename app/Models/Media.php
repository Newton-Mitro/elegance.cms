<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Media extends Model
{
    protected $fillable = ['file_name', 'file_path', 'file_type', 'alt_text', 'caption'];

    public function sections()
    {
        return $this->morphedByMany(PageSection::class, 'mediaable');
    }
}