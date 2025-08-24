<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::factory(8)->create(); // generate 8 pages
    }
}
