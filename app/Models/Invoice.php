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
        'executing_company_id',
        'amount_ht',
        'status',
        'organization_id',
    ];

    public function movingJob(): BelongsTo
    {
        return $this->belongsTo(MovingJob::class, 'moving_job_id', 'id');
    }

    public function executingCompany(): BelongsTo
    {
        return $this->belongsTo(ExecutingCompany::class, 'executing_company_id', 'id');
    }
}
