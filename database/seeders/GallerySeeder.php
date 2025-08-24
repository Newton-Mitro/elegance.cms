<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        Gallery::factory(12)->create();
    }
}
