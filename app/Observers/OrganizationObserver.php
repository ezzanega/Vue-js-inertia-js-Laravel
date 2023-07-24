<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\Organization;

class OrganizationObserver
{
    public function created(Organization $organization): void
    {
        $organization->addRole('admin');
        $organization->addRole('sales');
        $organization->addRole('operator');
        $organization->addRole('lead-operator');
    }
}
