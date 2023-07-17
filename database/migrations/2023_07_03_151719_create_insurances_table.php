<?php

use App\Models\Enums\InsuranceType;
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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->enum('type', InsuranceType::values());
            $table->string('max_value')->nullable();
            $table->string('franchise')->nullable();
            $table->string('amount_ht')->nullable();
            $table->foreignId('organization_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
