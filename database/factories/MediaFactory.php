<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition()
    {
        $sourceFolder = database_path('seeders/media');
        $files = glob($sourceFolder . '/*.*');

        if (empty($files)) {
            throw new \Exception("No sample media files found in {$sourceFolder}");
        }

        $randomFile = $this->faker->randomElement($files);
        $fileName = Str::uuid() . '.' . pathinfo($randomFile, PATHINFO_EXTENSION);

        // Use storage disk 'public'
        $disk = Storage::disk('public');

        // Copy file to storage/app/public/uploads
        $disk->putFileAs('uploads', new File($randomFile), $fileName);

        return [
            'file_name' => $fileName,
            'file_path' => 'storage/uploads/' . $fileName, // URL accessible via public/storage
            'file_type' => pathinfo($randomFile, PATHINFO_EXTENSION),
            'alt_text' => $this->faker->sentence(),
            'uploaded_by' => User::inRandomOrder()->first()?->id,
        ];

    }
}
