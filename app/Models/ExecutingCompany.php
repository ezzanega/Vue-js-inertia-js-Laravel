<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ExecutingCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'siret',
        'email',
        'phone_number',
        'siren',
        'field'
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(Location::class);
    }
}
