<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        Team::factory(8)->create();
    }
}
