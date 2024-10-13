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
        Schema::create('proformas', function (Blueprint $table) {
            $table->id();
            $table->string('proforma_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('provider')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->string('order_number')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('type_vehicle')->nullable();
            $table->decimal('net_weight',60,17)->nullable();
            $table->decimal('gross_weight',60,17)->nullable();
            $table->string('container_type')->nullable();
            $table->text('comment')->nullable();
            $table->date('date_quotation')->nullable();
            $table->boolean('status')->default(0);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proformas');
    }
};
