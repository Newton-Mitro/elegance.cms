<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->longText('bio')->nullable();
            $table->longText('message')->nullable();
            $table->string('department')->nullable();
            $table->foreignId('media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('facebook_links')->nullable();
            $table->string('twitter_links')->nullable();
            $table->string('linkedin_links')->nullable();
            $table->string('instagram_links')->nullable();
            $table->string('youtube_links')->nullable();
            $table->string('pinterest_links')->nullable();
            $table->string('tiktok_links')->nullable();
            $table->string('snapchat_links')->nullable();
            $table->string('whatsapp_links')->nullable();
            $table->string('telegram_links')->nullable();
            $table->string('github_links')->nullable();
            $table->string('discord_links')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();

            // $table->enum('category', ['Leader', 'Teacher', 'Doctor', 'Dentist', 'Nurse', 'Beautician', 'Hairstylist', 'Chef', 'Other Staff'])->default('Leader');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
