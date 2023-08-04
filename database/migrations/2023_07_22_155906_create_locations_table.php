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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->text('full_address')->nullable();
            $table->text('google_map_url')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->foreignId('client_id')->nullable();
            $table->foreignId('organization_id')->nullable();
            $table->foreignId('client_organization_id')->nullable();
            $table->foreignId('executing_company_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
