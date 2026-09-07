<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('why_choose_us', function (Blueprint $table) {
            $table->string('section_two_image_one')->nullable();
            $table->string('section_two_image_two')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('why_choose_us', function (Blueprint $table) {
            $table->dropColumn(['section_two_image_one', 'section_two_image_two']);
        });
    }
};