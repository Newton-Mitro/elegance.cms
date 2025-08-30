<?php

namespace Database\Factories;

use App\Infrastructure\Models\Category;
use App\Infrastructure\Models\Media;
use App\Infrastructure\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(3);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'description' => $this->faker->paragraph(5),
            'category' => $this->faker->randomElement(['Web Development', 'Mobile App', 'Data Science', 'AI/ML', 'Other']),
            'source_code_link' => $this->faker->url(),
            'live_site_link' => $this->faker->url(),
            'start_date' => $this->faker->dateTimeBetween('-2 years', '-6 months')->format('Y-m-d'),
            'end_date' => optional($this->faker->optional()->dateTimeBetween('-6 months', 'now'))->format('Y-m-d'),
            'gallery' => Media::inRandomOrder()->take(2)->get()->pluck('url')->toArray(),
            'category_id' => Category::where('category_of', 'Project')->inRandomOrder()->first()?->id
                ?? Category::factory()->create(['category_of' => 'Project'])->id,

            'media_id' => Media::inRandomOrder()->first()?->id,
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
