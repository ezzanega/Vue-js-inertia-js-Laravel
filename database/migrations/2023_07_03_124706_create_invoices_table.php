<?php

use App\Models\Enums\InvoiceType;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->enum('type', InvoiceType::values());
            $table->string('number');
            $table->string('total_excl_tax');
            $table->string('vat');
            $table->string('total_incl_tax');
            $table->string('invoice_at');
            $table->text('contract_terms')->nullable();
            $table->text('legal_terms')->nullable();
            $table->bigInteger('organization_id')->nullable();
            $table->foreignId('document_id');
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
