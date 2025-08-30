<?php

namespace Database\Factories;

use App\Infrastructure\Models\Category;
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
            'gallery' => Media::inRandomOrder()->take(2)->get()->pluck('url')->toArray(),
            'icon_media_id' => Media::inRandomOrder()->first()?->id,
            'media_id' => Media::inRandomOrder()->first()?->id,

            // ✅ Only pick categories that belong to "Service"
            'category_id' => Category::where('category_of', 'Service')->inRandomOrder()->first()?->id
                ?? Category::factory()->create(['category_of' => 'Service'])->id,

            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
