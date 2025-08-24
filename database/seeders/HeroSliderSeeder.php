<?php

namespace Database\Seeders;

use App\Infrastructure\Models\HeroSlider;
use Illuminate\Database\Seeder;

class HeroSliderSeeder extends Seeder
{
    public function run(): void
    {
        HeroSlider::factory(6)->create();
    }
}
