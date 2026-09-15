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
        $table->string('banner_video')->nullable()->after('image');
    });
}

public function down(): void
{
    Schema::table('service_sections', function (Blueprint $table) {
        $table->dropColumn('banner_video');
    });
}
};
