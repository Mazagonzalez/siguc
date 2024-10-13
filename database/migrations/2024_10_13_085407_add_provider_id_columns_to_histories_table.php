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
        Schema::table('histories', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('type_request')->nullable();
            $table->unsignedBigInteger('provider_id')->after('user_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('provider_id');
        });
    }
};
