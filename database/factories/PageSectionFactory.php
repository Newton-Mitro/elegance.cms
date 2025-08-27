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
            'comma_separated_list',
            'json_array_with_img_text',
            'json_array_with_icon_text',
            'json_array_with_question_answer',
            'custom_html',
        ];

        $contentType = $this->faker->randomElement($sectionTypes);

        return [
            'page_id' => Page::inRandomOrder()->first()?->id ?? Page::factory(),
            'heading' => $this->faker->sentence(4),
            'sub_heading' => $this->faker->sentence(6),
            'button_text' => $this->faker->optional()->word(),
            'button_link' => $this->faker->optional()->url(),
            'content' => $this->generateContent($contentType),
            'gallery' => $this->faker->boolean(70)
                ? collect(range(1, rand(1, 3)))
                    ->map(fn() => Media::inRandomOrder()->first()->url)
                    ->toArray()
                : null,
            'media_id' => Media::inRandomOrder()->first()?->id ?? null,
            'content_type' => $contentType,
            'sort_order' => $this->faker->numberBetween(0, 10),
        ];
    }

    private function generateContent(string $type): ?string
    {
        switch ($type) {
            case 'comma_separated_list':
                return implode(',', $this->faker->words(rand(3, 7)));

            case 'json_array_with_img_text':
                return json_encode(
                    collect(range(1, rand(2, 4)))->map(fn() => [
                        'img' => Media::inRandomOrder()->first()->url,
                        'text' => $this->faker->sentence(6),
                    ])
                );

            case 'json_array_with_icon_text':
                return json_encode(
                    collect(range(1, rand(2, 4)))->map(fn() => [
                        'icon' => 'fa fa-' . $this->faker->randomElement(['star', 'check', 'times', 'heart']),
                        'text' => $this->faker->sentence(5),
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
                return $this->faker->paragraphs(5, true);
        }
    }
}
