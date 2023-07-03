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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('capacity');
            $table->string('formula');
            $table->string('loading_address');
            $table->timestamp('loading_date');
            $table->string('loading_floor');
            $table->string('loading_elevator');
            $table->string('loading_portaging');
            $table->string('loading_details');
            $table->string('shipping_address');
            $table->timestamp('shipping_date');
            $table->string('shipping_floor');
            $table->string('shipping_elevator');
            $table->string('shipping_portaging');
            $table->string('shipping_details');
            $table->string('discount_percentage');
            $table->string('discount_amount');
            $table->string('advance');
            $table->string('balance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
