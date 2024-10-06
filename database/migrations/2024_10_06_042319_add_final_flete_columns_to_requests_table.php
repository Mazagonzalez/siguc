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
            $table->string('driver_phone')->after('driver_name')->nullable();
            $table->decimal('initial_flete', 60, 17)->after('identification')->nullable();
            $table->decimal('final_flete', 60, 17)->after('time_response')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn('driver_phone');
            $table->dropColumn('initial_flete');
            $table->dropColumn('final_flete');
        });
    }
};
