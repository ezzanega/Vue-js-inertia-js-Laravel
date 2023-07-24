<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdditionalField extends Model
{
    use HasFactory;

    protected $attributes = [
        'description' => ''
    ];
    
    protected $fillable = [
        'type',
        'description',
        'position',
        'moving_job_id',
        'quotation_id',
        'waybill_id',
        'invoice_id'
    ];

    public function movingJob(): BelongsTo
    {
        return $this->belongsTo(MovingJob::class, 'moving_job_id', 'id');
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class, 'quotation_id', 'id');
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'waybill_id', 'id');
    }

    public function waybill(): BelongsTo
    {
        return $this->belongsTo(Waybill::class, 'invoice_id', 'id');
    }
}
