<?php

use App\Models\Enums\InvoiceType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Enums\InvoiceStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->enum('type', InvoiceType::values());
            $table->string('number')->nullable();
            $table->string('amount_ht')->nullable();
            $table->enum('status', InvoiceStatus::values());
            $table->string('executing_company')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
