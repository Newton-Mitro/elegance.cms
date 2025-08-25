<?php

namespace Database\Factories;

use App\Infrastructure\Models\Notice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NoticeFactory extends Factory
{
    protected $model = Notice::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(4);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'content' => $this->faker->paragraph(8),
            'publish_date' => $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'expiry_date' => optional($this->faker->optional()->dateTimeBetween('now', '+6 months'))->format('Y-m-d'),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
