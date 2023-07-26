<?php

namespace App\Models;

use App\Models\Organization;
use App\Models\MovingJobFormulaOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovingJobFormula extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }


    public function options(): HasMany
    {
        return $this->hasMany(MovingJobFormulaOption::class);
    }
}
