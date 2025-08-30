<?php

namespace Database\Factories;

use App\Infrastructure\Models\Category;
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
        $price = $this->faker->randomFloat(2, 10, 1000);

        return [
            'name' => ucfirst($title),
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'description' => $this->faker->paragraph(4),
            'price' => $price,

            // ✅ Discount price (sometimes lower than price, sometimes null)
            'discount_price' => $this->faker->boolean(70)
                ? $this->faker->randomFloat(2, 5, $price)
                : null,

            'stock' => $this->faker->numberBetween(0, 500),
            'sku' => strtoupper(Str::random(8)),

            // ✅ Better: return array, let Eloquent JSON casting handle it
            'gallery' => Media::inRandomOrder()->take(2)->get()->pluck('url')->toArray(),

            'media_id' => Media::inRandomOrder()->first()?->id,

            // ✅ Always pick Product categories
            'category_id' => Category::where('category_of', 'Product')->inRandomOrder()->first()?->id
                ?? Category::factory()->create(['category_of' => 'Product'])->id,

            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
