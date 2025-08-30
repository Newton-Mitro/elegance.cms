<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('route_visit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('route'); // named route or URI
            $table->string('method', 10); // GET, POST, etc.
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->json('query_params')->nullable();
            $table->json('request_body')->nullable();
            $table->timestamp('visited_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('route_visit_logs');
    }
};
