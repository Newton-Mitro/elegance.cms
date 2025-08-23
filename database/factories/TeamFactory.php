<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'designation' => $this->faker->jobTitle(),
            'bio' => $this->faker->paragraph(6),
            'photo_media_id' => Media::inRandomOrder()->first()?->id,
            'social_links' => json_encode([
                'facebook' => 'https://facebook.com/' . $this->faker->userName(),
                'twitter' => 'https://twitter.com/' . $this->faker->userName(),
                'linkedin' => 'https://linkedin.com/in/' . $this->faker->userName(),
                'github' => 'https://github.com/' . $this->faker->userName(),
            ]),
        ];
    }
}
