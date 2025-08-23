<?php

namespace Database\Factories;

use App\Models\PageSection;
use App\Models\Page;
use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageSectionFactory extends Factory
{
    protected $model = PageSection::class;

    public function definition(): array
    {
        $sectionTypes = [
            'comma_seperated_list',
            'json_array_with_img_text',
            'json_array_with_fa_icon_&_text',
            'json_array_with_question_&_answer',
            'custom_html',
        ];

        return [
            'page_id' => Page::inRandomOrder()->first()?->id ?? Page::factory(),
            'heading' => $this->faker->sentence(4),
            'sub_heading' => $this->faker->optional()->sentence(6),
            'button_text' => $this->faker->optional()->word(),
            'button_link' => $this->faker->optional()->url(),
            'content' => $this->faker->paragraphs(3, true),
            'gallery' => $this->faker->optional()->boolean(70) ? json_encode(
                collect(range(1, rand(1, 3)))->map(fn() => $this->faker->imageUrl(640, 480))->toArray()
            ) : null,
            'media_id' => Media::inRandomOrder()->first()?->id ?? null,
            'section_type' => $this->faker->randomElement($sectionTypes),
            'sort_order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
