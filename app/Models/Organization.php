<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
use App\Models\Location;
use App\Models\MovingJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'siret',
        'siren',
        'billing_address',
        'owner_id'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function billingAddress(): HasOne
    {
        return $this->hasOne(Location::class);
    }
}
