<?php

namespace Database\Factories;

use App\Infrastructure\Models\HeroSlider;
use App\Infrastructure\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class HeroSliderFactory extends Factory
{
    protected $model = HeroSlider::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'subtitle' => $this->faker->optional()->sentence(6),
            'button_text' => $this->faker->optional()->word(),
            'button_link' => $this->faker->optional()->url(),
            'media_id' => Media::inRandomOrder()->first()?->id,
            'sort_order' => $this->faker->numberBetween(0, 10),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
