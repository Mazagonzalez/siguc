<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('provider')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('container_type')->nullable();
            $table->decimal('order_weight',60,17)->nullable();
            $table->date('date_quotation')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
