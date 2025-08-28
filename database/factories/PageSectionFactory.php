<?php

namespace Database\Factories;

use App\Infrastructure\Models\Media;
use App\Infrastructure\Models\Page;
use App\Infrastructure\Models\PageSection;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageSectionFactory extends Factory
{
    protected $model = PageSection::class;

    public function definition(): array
    {
        $sectionTypes = [
            'json_array_with_image_title',
            'json_array_with_image_title_and_subtitle',
            'json_array_with_icon_title_and_subtitle',
            'json_array_with_title',
            'json_array_with_question_answer',
            'custom_html',
        ];

        $contentType = $this->faker->randomElement($sectionTypes);

        // Ensure we have a page
        $page = Page::inRandomOrder()->first() ?? Page::factory()->create();

        // Optionally fetch a random media
        $media = Media::inRandomOrder()->first();

        // Optionally generate a gallery array of URLs
        $gallery = $this->faker->boolean(70)
            ? collect(range(1, rand(1, 3)))
                ->map(fn() => Media::inRandomOrder()->first()?->url)
                ->filter()
                ->toArray()
            : null;

        return [
            'page_id' => $page->id,
            'heading' => $this->faker->sentence(4),
            'sub_heading' => $this->faker->sentence(6),
            'button_text' => $this->faker->word(),
            'button_link' => $this->faker->url(),
            'content' => $this->generateContent($contentType),
            'gallery' => $gallery,
            'media_id' => $media?->id,
            'content_type' => $contentType === 'custom_html' ? 'custom_html' : 'json_array',
            'sort_order' => $this->faker->numberBetween(0, 10),
        ];
    }

    private function generateContent(string $type): ?string
    {
        switch ($type) {
            case 'json_array_with_image_title':
                return json_encode(
                    collect(range(1, rand(2, 4)))->map(fn() => [
                        'image' => Media::inRandomOrder()->first()?->url,
                        'title' => $this->faker->sentence(6),
                    ])->filter(fn($item) => $item['image'])
                );

            case 'json_array_with_image_title_and_subtitle':
                return json_encode(
                    collect(range(1, rand(2, 4)))->map(fn() => [
                        'image' => Media::inRandomOrder()->first()?->url,
                        'title' => $this->faker->sentence(6),
                        'subtitle' => $this->faker->paragraph(),
                    ])->filter(fn($item) => $item['image'])
                );

            case 'json_array_with_icon_title_and_subtitle':
                return json_encode(
                    collect(range(1, rand(2, 4)))->map(fn() => [
                        'icon' => 'fa fa-' . $this->faker->randomElement(['star', 'check', 'times', 'heart']),
                        'title' => $this->faker->sentence(4),
                        'subtitle' => $this->faker->paragraph(),
                    ])
                );

            case 'json_array_with_title':
                return json_encode(
                    collect(range(1, rand(2, 4)))->map(fn() => [
                        'title' => $this->faker->sentence(6),
                    ])
                );

            case 'json_array_with_question_answer':
                return json_encode(
                    collect(range(1, rand(2, 4)))->map(fn() => [
                        'question' => $this->faker->sentence(6) . '?',
                        'answer' => $this->faker->paragraph(),
                    ])
                );

            case 'custom_html':
                return "<div><h3>{$this->faker->sentence(3)}</h3><p>{$this->faker->paragraph()}</p></div>";

            default:
                return null;
        }
    }
}
