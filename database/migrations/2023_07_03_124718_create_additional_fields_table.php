<?php

use App\Models\Enums\AdditionalFieldsType;
use App\Models\Enums\Positions;
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
        Schema::create('additional_fields', function (Blueprint $table) {
            $table->id();
            $table->enum('type', AdditionalFieldsType::values());
            $table->enum('position', Positions::values());
            $table->string('description')->nullable();
            $table->foreignId('moving_job_id')->nullable();
            $table->foreignId('quotation_id')->nullable();
            $table->foreignId('waybill_id')->nullable();
            $table->foreignId('invoice_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_fields');
    }
};
