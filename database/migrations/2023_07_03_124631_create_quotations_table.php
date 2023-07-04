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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('number');
            $table->string('amount');
            $table->string('formula');
            $table->string('payment_condition');
            $table->string('validity_duratation');
            $table->string('distance');
            $table->string('volume');
            $table->string('estimated_value_of_assets');
            $table->unsignedBigInteger('advisor_id')->nullable();
            $table->foreignId('moving_job_id')->nullable();
            $table->foreignId('client_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
