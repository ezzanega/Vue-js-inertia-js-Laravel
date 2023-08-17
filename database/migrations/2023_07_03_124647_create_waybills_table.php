<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Enums\WaybillStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('waybills', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('number')->nullable();
            $table->string('executing_company')->nullable();
            $table->enum('status', WaybillStatus::values());
            $table->foreignId('executing_company_id')->nullable();
            $table->foreignId('organization_id')->nullable();
            $table->foreignId('moving_job_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waybills');
    }
};
