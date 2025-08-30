<?php

namespace Database\Factories;

use App\Infrastructure\Models\Gallery;
use App\Infrastructure\Models\GalleryMedia;
use App\Infrastructure\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryMediaFactory extends Factory
{
    protected $model = GalleryMedia::class;
    public function definition(): array
    {
        return [
            'caption' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(),
            'media_id' => Media::inRandomOrder()->value('id'),
            'gallery_id' => Gallery::inRandomOrder()->value('id'),
        ];
    }
}
