<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;

class PostCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        Post::all()->each(function ($post) use ($categories) {
            // attach 1 to 3 random categories per post
            $post->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
