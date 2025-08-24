<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::factory(10)->create();
    }
}
