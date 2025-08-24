<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::factory(12)->create();
    }
}
