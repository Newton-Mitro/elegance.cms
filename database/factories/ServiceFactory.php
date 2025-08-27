<?php

namespace Database\Factories;

use App\Infrastructure\Models\Media;
use App\Infrastructure\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(3);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'description' => $this->faker->paragraph(5),
            'gallery' => json_encode([
                $this->faker->imageUrl(640, 480, 'business'),
                $this->faker->imageUrl(640, 480, 'technology'),
            ]),
            'icon_media_id' => Media::inRandomOrder()->first()?->id,
            'media_id' => Media::inRandomOrder()->first()?->id,
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
