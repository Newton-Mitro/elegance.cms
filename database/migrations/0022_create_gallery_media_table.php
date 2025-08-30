<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gallery_media', function (Blueprint $table) {
            $table->id();
            $table->string('caption')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('media_id')->constrained('media')->cascadeOnDelete();
            $table->foreignId('gallery_id')->constrained('galleries')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_media');
    }
};
