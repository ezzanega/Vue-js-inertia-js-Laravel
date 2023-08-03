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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_validity_duratation')->nullable();
            $table->string('ducuments_primary_color')->nullable();
            $table->string('ducuments_secondary_color')->nullable();
            $table->longText('ducuments_general_conditions')->nullable();
            $table->longText('legal_notice')->nullable();
            $table->string('vat')->nullable();
            $table->foreignId('organization_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
