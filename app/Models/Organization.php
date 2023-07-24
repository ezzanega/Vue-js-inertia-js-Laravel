<?php

namespace App\Models;

use App\Models\Role;
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
        'email',
        'phone_number',
        'siren',
        'code_ape',
        'licence',
        'owner_id'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'organization_role');
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function billingAddress(): HasOne
    {
        return $this->hasOne(Location::class);
    }

    public function addRole($roleName)
    {
        $role = Role::findOrCreate($roleName);
        $this->roles()->attach($role);
    }
}
