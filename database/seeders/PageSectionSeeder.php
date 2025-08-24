<?php

namespace Database\Seeders;

use App\Infrastructure\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSectionSeeder extends Seeder
{
    public function run(): void
    {
        PageSection::factory(20)->create(); // generate 20 page sections
    }
}
