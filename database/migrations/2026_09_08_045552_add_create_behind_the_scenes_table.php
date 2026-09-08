<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('behind_the_scenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('video')->nullable();      // uploaded video file path
            $table->string('video_url')->nullable();  // external video link (YouTube etc.)
            $table->string('image')->nullable();       // uploaded image path
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('behind_the_scenes');
    }
};