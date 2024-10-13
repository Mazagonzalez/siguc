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
        Schema::create('request_exportations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('provider')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->string('order_number')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('type_vehicle')->nullable();
            $table->decimal('total_net_weight',60,17)->nullable();
            $table->decimal('total_gross_weight',60,17)->nullable();
            $table->string('vehicle_quantity')->nullable();
            $table->text('comment')->nullable();
            $table->date('date_quotation')->nullable();
            $table->string('order_quantity')->nullable();
            $table->boolean('status')->default(0);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_exportation');
    }
};
