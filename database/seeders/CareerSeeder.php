<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        Career::factory(8)->create();
    }
}
