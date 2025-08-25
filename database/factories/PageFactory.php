<?php

namespace Database\Factories;

use App\Infrastructure\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(3);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'meta_title' => $this->faker->sentence(5),
            'meta_description' => $this->faker->paragraph(2),
        ];
    }
}
