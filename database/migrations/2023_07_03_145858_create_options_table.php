<?php

use App\Models\Enums\OptionType;
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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('designation')->nullable();
            $table->string('quantity')->nullable();
            $table->integer('unit')->nullable();
            $table->string('unit_price_ht')->nullable();
            $table->string('total_price_ht')->nullable();
            $table->foreignId('moving_job_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
