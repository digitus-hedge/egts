<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('why_choose_us', function (Blueprint $table) {
            $table->string('banner_heading')->nullable();
            $table->longText('banner_description')->nullable();
            $table->string('banner_image')->nullable();

            $table->string('about_heading')->nullable();
            $table->longText('about_description')->nullable();
            $table->string('about_image1')->nullable();
            $table->string('about_image2')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('why_choose_us', function (Blueprint $table) {
            $table->dropColumn([
                'banner_heading',
                'banner_description',
                'banner_image',
                'about_heading',
                'about_description',
                'about_image1',
                'about_image2',
            ]);
        });
    }
};