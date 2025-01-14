<?php

use App\Models\Enums\DocumentType;
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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->enum('type', DocumentType::values());
            $table->string('capacity');
            $table->string('formula');
            $table->string('loading_address');
            $table->string('loading_date');
            $table->string('loading_floor');
            $table->string('loading_elevator');
            $table->string('loading_portaging');
            $table->string('loading_details');
            $table->string('shipping_address');
            $table->string('shipping_date');
            $table->string('shipping_floor');
            $table->string('shipping_elevator');
            $table->string('shipping_portaging');
            $table->string('shipping_details');
            $table->string('discount_percentage');
            $table->string('discount_amount');
            $table->string('advance');
            $table->string('balance');
            $table->foreignId('additionnalField_id');
            $table->foreignId('option_id');
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
        Schema::dropIfExists('documents');
    }
};
