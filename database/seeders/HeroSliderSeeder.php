<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlider;

class HeroSliderSeeder extends Seeder
{
    public function run(): void
    {
        HeroSlider::factory(6)->create(); // generate 6 hero sliders
    }
}
