<?php

namespace Database\Factories;

use App\Infrastructure\Models\Gallery;
use App\Infrastructure\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(4),
            'media_id' => Media::inRandomOrder()->first()?->id,
        ];
    }
}
