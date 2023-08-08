<?php

namespace App\Models;

use App\Models\Location;
use App\Models\MovingJob;
use App\Models\Organization;
use App\Models\ClientOrganizations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'last_name',
        'first_name',
        'phone_number',
        'email',
        'source'
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function movingJobs(): HasMany
    {
        return $this->hasMany(MovingJob::class);
    }

    public function clientOrganization(): HasOne
    {
        return $this->hasOne(ClientOrganizations::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Location::class);
    }

    public function getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
