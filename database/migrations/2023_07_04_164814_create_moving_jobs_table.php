<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('moving_jobs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('capacity');
            $table->string('formula');
            $table->string('volume');
            $table->string('loading_address');
            $table->timestamp('loading_date');
            $table->string('loading_floor');
            $table->string('loading_elevator');
            $table->string('loading_portaging');
            $table->text('loading_details');
            $table->string('shipping_address');
            $table->timestamp('shipping_date');
            $table->string('shipping_floor');
            $table->string('shipping_elevator');
            $table->string('shipping_portaging');
            $table->text('shipping_details');
            $table->string('discount_percentage');
            $table->string('discount_amount_ht');
            $table->string('advance');
            $table->string('balance');
            $table->foreignId('organization_id');
            $table->foreignId('client_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moving_jobs');
    }
};
