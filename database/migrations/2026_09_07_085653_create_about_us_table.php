<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();

            // Banner section
            $table->string('banner_heading');
            $table->longText('banner_description');
            $table->string('banner_image')->nullable();

            // Section Two
            $table->string('section_two_heading');
            $table->longText('section_two_description');
            $table->string('section_two_image_one')->nullable();
            $table->string('section_two_image_two')->nullable();

            // Vision
            $table->string('vision_heading');
            $table->longText('vision_description');
            $table->string('vision_image')->nullable();

            // Mission
            $table->string('mission_heading');
            $table->longText('mission_description');
            $table->string('mission_image')->nullable();

            // Our Foundation (intro text)
            $table->string('foundation_heading');
            $table->longText('foundation_description');

            // Foundation List — fixed 2 items, flat columns
            $table->string('foundation_item_one_heading')->nullable();
            $table->longText('foundation_item_one_description')->nullable();
            $table->string('foundation_item_one_image')->nullable();

            $table->string('foundation_item_two_heading')->nullable();
            $table->longText('foundation_item_two_description')->nullable();
            $table->string('foundation_item_two_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};