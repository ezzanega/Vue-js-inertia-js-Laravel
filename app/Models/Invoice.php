<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'number',
        'total_excl_tax',
        'vat',
        'total_incl_tax',
        'invoice_at',
        'contract_terms',
        'legal_terms',
        'document_id',
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }
}
