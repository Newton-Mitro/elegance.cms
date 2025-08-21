<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'meta_title', 'meta_description', 'status'];

    public function sections()
    {
        return $this->hasMany(PageSection::class);
    }
}
