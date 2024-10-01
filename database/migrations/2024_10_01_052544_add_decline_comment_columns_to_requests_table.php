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
            $table->text('decline_comment')->after('date_loading')->nullable();
            $table->boolean('double_order')->after('decline_comment')->default(0);
            $table->unsignedBigInteger('id_request_double')->nullable()->after('double_order');

            $table->foreign('id_request_double')->references('id')->on('requests')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn('decline_comment');
            $table->dropColumn('double_order');
            $table->dropForeign(['id_request_double']);
            $table->dropColumn('id_request_double');
        });
    }
};
