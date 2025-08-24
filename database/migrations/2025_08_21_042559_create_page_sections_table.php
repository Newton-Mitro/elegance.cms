<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
            $table->string('heading')->nullable();
            $table->string('sub_heading')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->longText('content')->nullable();
            $table->json('gallery')->nullable();
            $table->foreignId('media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->enum('content_type', [
                'comma_seperated_list',
                'json_array_with_img_text',
                'json_array_with_fa_icon_&_text',
                'json_array_with_question_&_answer',
                'custom_html',
            ])->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
