<?php

namespace Database\Factories;

use App\Infrastructure\Models\Event;
use App\Infrastructure\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(4);

        $startDate = $this->faker->dateTimeBetween('-6 months', '+6 months');
        $endDate = $this->faker->optional()->dateTimeBetween($startDate, '+1 year');

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'description' => $this->faker->paragraph(6),
            'location' => $this->faker->city(),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate?->format('Y-m-d'),
            'banner_media_id' => Media::inRandomOrder()->first()?->id,
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
