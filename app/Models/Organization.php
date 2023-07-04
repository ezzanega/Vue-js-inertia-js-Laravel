<?php

namespace App\Models;

use App\Models\User;
use App\Models\MovingJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'siret',
        'siren',
        'address',
        'billing_address',
        'owner_id'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function movingJobs(): HasMany
    {
        return $this->hasMany(MovingJob::class);
    }
}
