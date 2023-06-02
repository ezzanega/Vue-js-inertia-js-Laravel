<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'super-admin']);
        $teamOwner = Role::create(['name' => 'team-owner']);
        $sales = Role::create(['name' => 'sales']);
        $operator = Role::create(['name' => 'operator']);
        $leadOperator = Role::create(['name' => 'lead-operator']);

        Permission::create(['name' => 'can-access-to-dashboard-page']);
        Permission::create(['name' => 'can-access-to-clients-page']);
        Permission::create(['name' => 'can-access-to-documents-page']);
        Permission::create(['name' => 'can-access-to-templates-page']);
        Permission::create(['name' => 'can-access-to-settings-page']);
        Permission::create(['name' => 'can-access-to-team-management-page']);
        Permission::create(['name' => 'can-access-to-mobile-app']);

        $teamOwner->givePermissionTo(['can-access-to-dashboard-page', 'can-access-to-clients-page', 'can-access-to-documents-page', 'can-access-to-templates-page', 'can-access-to-settings-page', 'can-access-to-team-management-page']);
        $sales->givePermissionTo(['can-access-to-dashboard-page', 'can-access-to-clients-page', 'can-access-to-documents-page', 'can-access-to-templates-page', 'can-access-to-settings-page', 'can-access-to-team-management-page']);
        $leadOperator->givePermissionTo(['can-access-to-dashboard-page', 'can-access-to-clients-page', 'can-access-to-documents-page', 'can-access-to-templates-page', 'can-access-to-settings-page', 'can-access-to-team-management-page']);
        $operator->givePermissionTo(['can-access-to-mobile-app']);
    }
}
