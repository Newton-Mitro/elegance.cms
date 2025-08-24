<?php

namespace Database\Seeders;

use App\Infrastructure\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'super.admin@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        $this->call([
            SettingSeeder::class,
            MediaSeeder::class,
            PageSeeder::class,
            PageSectionSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            ServiceSeeder::class,
            ProjectSeeder::class,
            ProductSeeder::class,
            TeamSeeder::class,
            TestimonialSeeder::class,
            AwardSeeder::class,
            NoticeSeeder::class,
            EventSeeder::class,
            CareerSeeder::class,
            ContactSeeder::class,
            ContactMessageSeeder::class,
            GallerySeeder::class,
            HeroSliderSeeder::class,
            PostSeeder::class,
            PostCategorySeeder::class,
            PostTagSeeder::class,
            CommentSeeder::class,
            LikeSeeder::class,
        ]);
    }
}
