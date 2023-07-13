<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Enums\OptionType;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'designation',
        'quantity',
        'unit',
        'price_ht',
        'moving_job_id'
    ];

    public function movingJob(): BelongsTo
    {
        return $this->belongsTo(MovingJob::class, 'moving_job_id', 'id');
    }
}
