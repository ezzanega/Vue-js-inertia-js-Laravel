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
        Schema::create('client_organizations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('siret');
            $table->string('organization_name');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('source');
            $table->string('client_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_organizations');
    }
};
