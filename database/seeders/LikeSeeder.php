<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Post;
use App\Infrastructure\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();

        foreach ($posts as $post) {
            // Each post gets 0 to 10 likes
            $likeCount = rand(0, min(10, $users->count()));
            $likers = $users->random($likeCount);

            foreach ($likers as $user) {
                DB::table('likes')->updateOrInsert(
                    ['post_id' => $post->id, 'user_id' => $user->id],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
        }
    }
}
