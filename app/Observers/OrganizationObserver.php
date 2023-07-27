<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Organization;

class OrganizationObserver
{

    public function creating(Organization $movingjob): void
    {
        $movingjob->uuid = Str::uuid();
    }

    public function created(Organization $organization): void
    {
        $organization->addRole('admin');
        $organization->addRole('sales');
        $organization->addRole('operator');
        $organization->addRole('lead-operator');
    }
}
