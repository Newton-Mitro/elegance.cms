<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Category;
use App\Infrastructure\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Collect seeded media IDs
        $mediaIds = Media::pluck('id')->toArray();

        $categories = [
            'Product' => [
                'Electronics' => ['Mobiles', 'Laptops', 'Cameras'],
                'Clothing' => ['Men', 'Women', 'Kids'],
                'Books' => ['Fiction', 'Non-fiction', 'Education'],
                'Home Appliances' => ['Kitchen', 'Living Room', 'Bedroom'],
            ],
            'Service' => [
                'Development' => ['Web Development', 'Mobile Development'],
                'Design' => ['UI/UX Design', 'Graphic Design'],
                'Marketing' => ['SEO', 'Content Marketing'],
            ],
            'Team' => [
                'Management' => ['Executives', 'HR'],
                'Engineering' => ['Backend', 'Frontend', 'DevOps'],
                'Design' => ['UI', 'UX'],
                'Marketing' => ['Digital', 'Offline'],
            ],
            'Blog' => [
                'Tech Insights' => ['AI', 'Cloud', 'Programming'],
                'Business Strategy' => ['Startups', 'Leadership'],
                'Lifestyle' => ['Health', 'Travel', 'Food'],
            ],
            'Event' => [
                'Conferences' => ['Tech Summit', 'Business Expo'],
                'Workshops' => ['Coding Bootcamp', 'Design Thinking'],
                'Meetups' => ['Developers', 'Designers'],
            ],
            'Notice' => [
                'Announcements' => ['Policy Updates', 'New Releases'],
                'Exams' => ['Schedules', 'Results'],
                'General Notices' => ['Holidays', 'Maintenance'],
            ],
            'Project' => [
                'Open Source' => ['Libraries', 'Tools'],
                'Client Work' => ['Websites', 'Apps'],
                'Internal Tools' => ['Dashboards', 'APIs'],
            ],
        ];

        foreach ($categories as $categoryOf => $parents) {
            foreach ($parents as $parentName => $children) {
                // Ensure parent slug uniqueness
                $parent = Category::firstOrCreate(
                    [
                        'name' => $parentName,
                        'category_of' => $categoryOf,
                    ],
                    [
                        'slug' => Str::slug($parentName . '-' . strtolower($categoryOf)),
                        'description' => $parentName . ' main category',
                        'media_id' => $mediaIds[array_rand($mediaIds)] ?? null,
                    ]
                );

                foreach ($children as $childName) {
                    // Ensure child slug uniqueness
                    Category::firstOrCreate(
                        [
                            'name' => $childName,
                            'category_of' => $categoryOf,
                        ],
                        [
                            'slug' => Str::slug($childName . '-' . strtolower($categoryOf)),
                            'description' => $childName . ' subcategory',
                            'parent_id' => $parent->id,
                            'media_id' => $mediaIds[array_rand($mediaIds)] ?? null,
                        ]
                    );
                }
            }
        }
    }
}
