<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $disk = \Illuminate\Support\Facades\Storage::disk('public');

        if ($disk->exists('uploads')) {
            $disk->deleteDirectory('uploads');
        }

        Media::factory(count: 20)->create();
    }
}
