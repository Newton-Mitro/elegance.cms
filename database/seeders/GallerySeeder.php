<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Gallery;
use App\Infrastructure\Models\GalleryMedia;
use App\Infrastructure\Models\Media;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        // Create 5 galleries
        $galleries = Gallery::factory(5)->create();

        foreach ($galleries as $gallery) {
            // Attach 3–6 media per gallery
            $mediaIds = Media::inRandomOrder()->take(rand(3, 6))->pluck('id');

            foreach ($mediaIds as $mediaId) {
                GalleryMedia::factory()->create([
                    'gallery_id' => $gallery->id,
                    'media_id' => $mediaId,
                ]);
            }
        }
    }
}
