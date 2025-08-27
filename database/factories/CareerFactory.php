<?php

namespace Database\Factories;

use App\Infrastructure\Models\Career;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CareerFactory extends Factory
{
    protected $model = Career::class;

    public function definition(): array
    {
        $title = $this->faker->jobTitle();

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'description' => $this->faker->paragraphs(3, true),
            'requirements' => $this->faker->paragraphs(4, true),
            'location' => $this->faker->city(),
            'salary_range' => '$' . $this->faker->numberBetween(30000, 80000) . ' - $' . $this->faker->numberBetween(90000, 150000),
            'deadline' => optional($this->faker->optional()->dateTimeBetween('now', '+6 months'))->format('Y-m-d'),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
