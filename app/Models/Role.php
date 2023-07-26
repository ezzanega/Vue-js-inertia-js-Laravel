<?php

namespace App\Models;

use App\Models\Organization;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'organization_role');
    }
}
