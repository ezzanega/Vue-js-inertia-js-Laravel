<?php

namespace App\Models;

use App\Models\User;
use App\Models\MovingJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'validity_duratation',
        'organization_id'
    ];

    public function movingJob(): BelongsTo
    {
        return $this->belongsTo(MovingJob::class, 'moving_job_id', 'id');
    }

    /*public function advisor(): BelongsTo
    {
        return $this->belongsTo(Advisor::class, 'advisor_id', 'id');
    }*/
}
