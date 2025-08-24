<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Post;
use App\Infrastructure\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = Tag::all();

        Post::all()->each(function ($post) use ($tags) {
            // attach 1 to 5 random tags per post
            $post->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
