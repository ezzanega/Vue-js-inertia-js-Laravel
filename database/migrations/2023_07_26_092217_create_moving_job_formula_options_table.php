<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Enums\MovingJobFormulaOptionType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('moving_job_formula_options', function (Blueprint $table) {
            $table->id();
            $table->enum('type', MovingJobFormulaOptionType::values());
            $table->string('text');
            $table->foreignId('moving_job_formula_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moving_job_formula_options');
    }
};
