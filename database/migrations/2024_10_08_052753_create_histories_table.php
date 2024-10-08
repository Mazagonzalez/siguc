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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('type_request')->nullable();
            $table->unsignedBigInteger('request_id')->nullable();
            $table->unsignedBigInteger('request_thermoformed_id')->nullable();
            $table->unsignedBigInteger('request_export_id')->nullable();
            $table->boolean('status')->default(0);

            $table->timestamps();

            $table->foreign('request_id')->references('id')->on('requests')->onDelete('set null');
            $table->foreign('request_thermoformed_id')->references('id')->on('request_thermoformeds')->onDelete('set null');
            $table->foreign('request_export_id')->references('id')->on('request_exports')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
