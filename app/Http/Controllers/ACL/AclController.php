<?php

namespace App\Http\Controllers\ACL;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class AclController extends Controller
{

    public function create(): Response
    {
        $roles = $this->getAllRoles();
        $permissions = $this->getAllPermissions();

        return inertia('6dem/Manage', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'roleName' => 'required|string|max:125|unique:role,name',
        ]);

        Role::create(['name' => $request->roleName]);
        $this->create();
    }

    public function update(Request $request, $id){
        $request->validate([
            'roleName' => 'required|string|max:125|unique:role,name',
        ]);

        $role = Role::findById($id);
        $role->name = $request->roleName;
 
        $role->save();
    }

    public function getAllRoles()
    {
        $roles = DB::table('roles')->get();

        return $roles;
    }

    public function getAllPermissions()
    {
        $permissions = DB::table('permissions')->get();

        return $permissions;
    }

    public function assignPermissionToUsers(Request $request, $uuid)
    {
        $request->validate([
            'permissionName' => 'required|string|max:250|exists:permissions,name',
        ]);
        $user = User::where(['uuid' => $uuid])->first();
        $user->assignPermission($request->permissionName);
    }

    public function assignRoleToUsers(Request $request, $uuid)
    {
        $request->validate([
            'roleName' => 'required|string|max:250|exists:roles,name',
        ]);
        $user = User::where(['uuid' => $uuid])->first();
        $user->assignRole($request->roleName);
    }


    public function assignPermissionToRoles(Request $request)
    {
        $request->validate([
            'roleName' => 'required|string|max:250|exists:roles,name',
            'permissionName' => 'required',
        ]);
        $role = Role::where(['name' => $request->roleName])->first();
        foreach ($request->permissions as &$permission){
            $role->assignRole($permission);
        }
    }
}
