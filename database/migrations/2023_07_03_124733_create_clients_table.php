<?php

use App\Models\Enums\ClientType;
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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->enum('type', ClientType::values());
            $table->string('last_name');
            $table->string('first_name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('address');
            $table->string('source')->nullable();
            $table->foreignId('organization_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
