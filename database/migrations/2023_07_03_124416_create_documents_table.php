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
            $table->string('capacity')->nullable();
            $table->string('formula')->nullable();
            $table->string('loading_address')->nullable();
            $table->timestamp('loading_date')->nullable();
            $table->string('loading_floor')->nullable();
            $table->string('loading_elevator')->nullable();
            $table->string('loading_portaging')->nullable();
            $table->string('loading_details')->nullable();
            $table->string('shipping_address')->nullable();
            $table->timestamp('shipping_date')->nullable();
            $table->string('shipping_floor')->nullable();
            $table->string('shipping_elevator')->nullable();
            $table->string('shipping_portaging')->nullable();
            $table->string('shipping_details')->nullable();
            $table->string('discount_percentage')->nullable();
            $table->string('discount_amount')->nullable();
            $table->string('advance')->nullable();
            $table->string('balance')->nullable();
            $table->unsignedBigInteger('additionnalField_id')->nullable();
            $table->unsignedBigInteger('option_id')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
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
