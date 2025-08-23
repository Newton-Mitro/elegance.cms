<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'author_name' => $this->faker->name(),
            'author_designation' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            'message' => $this->faker->paragraph(6),
            'photo_media_id' => Media::inRandomOrder()->first()?->id,
            'rating' => $this->faker->numberBetween(3, 5), // ratings between 3–5
        ];
    }
}
