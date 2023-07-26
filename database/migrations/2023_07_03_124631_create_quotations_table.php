<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Enums\QuotationStatus;

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
            $table->string('number')->nullable();
            $table->enum('status', QuotationStatus::values());
            $table->string('validity_duratation')->nullable();
            $table->bigInteger('organization_id')->nullable();
            $table->foreignId('advisor_id')->nullable();
            $table->foreignId('moving_job_id')->nullable();
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
