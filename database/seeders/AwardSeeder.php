<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Award;
use Illuminate\Database\Seeder;

class AwardSeeder extends Seeder
{
    public function run(): void
    {
        Award::factory(10)->create();
    }
}
