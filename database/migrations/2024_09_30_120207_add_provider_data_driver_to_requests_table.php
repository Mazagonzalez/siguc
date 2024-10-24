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
        Schema::table('requests', function (Blueprint $table) {
            $table->string('license_plate')->after('comment')->nullable();
            $table->string('driver_name')->after('license_plate')->nullable();
            $table->string('identification')->after('driver_name')->nullable();
            $table->dateTime('date_acceptance')->after('identification')->nullable();
            $table->dateTime('date_loading')->after('date_acceptance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn('license_plate');
            $table->dropColumn('driver_name');
            $table->dropColumn('identification');
            $table->dropColumn('date_acceptance');
            $table->dropColumn('date_loading');
        });
    }
};
