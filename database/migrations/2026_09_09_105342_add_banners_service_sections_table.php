<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('service_sections', function (Blueprint $table) {
            if (!Schema::hasColumn('service_sections', 'image')) {
                $table->string('image')->nullable();
            }

            if (!Schema::hasColumn('service_sections', 'banner_heading')) {
                $table->string('banner_heading')->nullable();
            }

            if (!Schema::hasColumn('service_sections', 'banner_description')) {
                $table->text('banner_description')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_sections', function (Blueprint $table) {
            if (Schema::hasColumn('service_sections', 'banner_description')) {
                $table->dropColumn('banner_description');
            }

            if (Schema::hasColumn('service_sections', 'banner_heading')) {
                $table->dropColumn('banner_heading');
            }

            if (Schema::hasColumn('service_sections', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};