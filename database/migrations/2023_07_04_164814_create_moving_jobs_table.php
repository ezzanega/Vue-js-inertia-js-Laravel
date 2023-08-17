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
            $table->string('capacity')->nullable();
            $table->string('formula')->nullable();
            $table->string('loading_address')->nullable();
            $table->string('loading_date')->nullable();
            $table->string('loading_floor')->nullable();
            $table->string('loading_elevator')->nullable();
            $table->string('loading_portaging')->nullable();
            $table->text('loading_details')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_date')->nullable();
            $table->string('shipping_floor')->nullable();
            $table->string('shipping_elevator')->nullable();
            $table->string('shipping_portaging')->nullable();
            $table->text('shipping_details')->nullable();
            $table->string('payment_process')->nullable();
            $table->string('discount')->nullable();
            $table->string('amount_ht')->nullable();
            $table->string('amount_ttc')->nullable();
            $table->string('amount_tva')->nullable();
            $table->string('advance')->nullable();
            $table->string('balance')->nullable();
            $table->string('distance')->nullable();
            $table->foreignId('organization_id')->nullable();
            $table->foreignId('client_id')->nullable();
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
