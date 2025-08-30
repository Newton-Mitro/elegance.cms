<?php

namespace Database\Factories;

use App\Infrastructure\Models\Category;
use App\Infrastructure\Models\Media;
use App\Infrastructure\Models\Team;
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
            'message' => $this->faker->sentence(),
            'department' => $this->faker->word(),
            'media_id' => Media::inRandomOrder()->first()?->id,

            'facebook_links' => 'https://facebook.com/' . $this->faker->userName(),
            'twitter_links' => 'https://twitter.com/' . $this->faker->userName(),
            'linkedin_links' => 'https://linkedin.com/in/' . $this->faker->userName(),
            'instagram_links' => 'https://instagram.com/' . $this->faker->userName(),
            'youtube_links' => 'https://youtube.com/' . $this->faker->userName(),
            'pinterest_links' => 'https://pinterest.com/' . $this->faker->userName(),
            'tiktok_links' => 'https://tiktok.com/@' . $this->faker->userName(),
            'snapchat_links' => 'https://snapchat.com/add/' . $this->faker->userName(),
            'whatsapp_links' => 'https://wa.me/' . $this->faker->phoneNumber(),
            'telegram_links' => 'https://t.me/' . $this->faker->userName(),
            'github_links' => 'https://github.com/' . $this->faker->userName(),
            'discord_links' => 'https://discordapp.com/users/' . $this->faker->randomNumber(6),

            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),

            'category_id' => Category::where('category_of', 'Team')->inRandomOrder()->first()?->id
                ?? Category::factory()->create(['category_of' => 'Team'])->id,

            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
