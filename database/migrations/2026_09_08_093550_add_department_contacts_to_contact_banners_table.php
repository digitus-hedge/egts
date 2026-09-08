<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_banners', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('title');

            $table->string('admin_phone')->nullable()->after('working_hours');
            $table->string('admin_email')->nullable()->after('admin_phone');

            $table->string('qaqc_phone')->nullable()->after('admin_email');
            $table->string('qaqc_email')->nullable()->after('qaqc_phone');

            $table->string('operations_phone')->nullable()->after('qaqc_email');
            $table->string('operations_email')->nullable()->after('operations_phone');

            $table->string('sales_phone')->nullable()->after('operations_email');
            $table->string('sales_email')->nullable()->after('sales_phone');
        });
    }

    public function down(): void
    {
        Schema::table('contact_banners', function (Blueprint $table) {
            $table->dropColumn([
                'company_name',
                'admin_phone', 'admin_email',
                'qaqc_phone', 'qaqc_email',
                'operations_phone', 'operations_email',
                'sales_phone', 'sales_email',
            ]);
        });
    }
};
