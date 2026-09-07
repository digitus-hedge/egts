<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('why_choose_us', function (Blueprint $table) {
            $table->longText('mission_description_rich')->nullable()->after('mission_description');
            $table->longText('vision_description_rich')->nullable()->after('vision_description');
            $table->longText('values_description_rich')->nullable()->after('values_description');
               $table->longText('commitment_description_rich')->nullable()->after('commitment_description');
        });
    }

    public function down(): void
    {
        Schema::table('why_choose_us', function (Blueprint $table) {
            $table->dropColumn([
                'mission_description_rich',
                'vision_description_rich',
                'values_description_rich',
                   'commitment_description_rich',
            ]);
        });
    }
};