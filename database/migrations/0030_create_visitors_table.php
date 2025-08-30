<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique(); // identify visitor session
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('device')->nullable(); // e.g. Mobile, Desktop
            $table->string('browser')->nullable(); // e.g. Chrome, Safari
            $table->string('os')->nullable(); // e.g. Windows, iOS
            $table->timestamp('last_activity')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
