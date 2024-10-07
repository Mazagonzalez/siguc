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
        Schema::create('request_thermoformeds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('provider')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('city')->nullable();
            $table->string('type_vehicle')->nullable();
            $table->string('container_type')->nullable();
            $table->integer('box_quantity')->nullable();
            $table->date('date_quotation')->nullable();
            $table->text('comment')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_phone')->nullable();
            $table->string('identification')->nullable();
            $table->decimal('initial_flete',60,17)->nullable();
            $table->dateTime('date_acceptance')->nullable();
            $table->string('time_response')->nullable();
            $table->decimal('final_flete',60,17)->nullable();
            $table->text('delivery_commentary')->nullable();
            $table->dateTime('date_loading')->nullable();
            $table->dateTime('date_decline')->nullable();
            $table->text('decline_comment')->nullable();
            $table->text('user_decline_comment')->nullable();
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
        Schema::dropIfExists('request_thermoformeds');
    }
};
