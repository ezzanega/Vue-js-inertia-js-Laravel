<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'validity_duratation'
    ];

    public function movingjobs(): BelongsTo
    {
        return $this->belongsTo(MovingJob::class, 'moving_job_id', 'id');
    }

   /*public function advisor(): BelongsTo
    {
        return $this->belongsTo(Advisor::class, 'advisor_id', 'id');
    }*/
}
