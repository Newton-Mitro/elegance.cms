<?php

namespace Database\Factories;

use App\Models\Award;
use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class AwardFactory extends Factory
{
    protected $model = Award::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'organization' => $this->faker->company(),
            'year' => $this->faker->year(),
            'description' => $this->faker->optional()->paragraph(4),
            'image_media_id' => Media::inRandomOrder()->first()?->id,
        ];
    }
}
