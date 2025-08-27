<?php

namespace Database\Factories;

use App\Infrastructure\Models\Media;
use App\Infrastructure\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->words(3, true);

        return [
            'title' => ucfirst($title),
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'description' => $this->faker->paragraph(4),
            'price' => $this->faker->randomFloat(2, 10, 1000), // price between 10.00 and 1000.00
            'gallery' => json_encode([
                $this->faker->imageUrl(600, 600, 'product'),
                $this->faker->imageUrl(600, 600, 'shopping'),
            ]),
            'media_id' => Media::inRandomOrder()->first()?->id,
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
