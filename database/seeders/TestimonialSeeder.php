<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::factory(12)->create();
    }
}
