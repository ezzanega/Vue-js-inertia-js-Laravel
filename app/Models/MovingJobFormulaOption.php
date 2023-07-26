<?php

namespace App\Models;

use App\Models\MovingJobFormula;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovingJobFormulaOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'text',
    ];

    public function formula(): BelongsTo
    {
        return $this->belongsTo(MovingJobFormula::class, 'moving_job_formula_id', 'id');
    }
}
