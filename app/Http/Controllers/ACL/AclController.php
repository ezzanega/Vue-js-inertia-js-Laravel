<?php

namespace App\Http\Controllers\ACL;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\InviteUser;
use Illuminate\Http\Request;
use App\Models\EmailTemplates;
use App\Mail\GenericMailHandler;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

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
            'roleName' => 'required|string|max:125|unique:roles,name',
            'permissions' => 'required',
        ]);

        $role = Role::create(['name' => $request->roleName]);
        $role->syncPermissions($request->permissions);
        $this->create();
    }

    public function update(Request $request, $id)
    {
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
        foreach ($request->permissions as &$permission) {
            $role->assignRole($permission);
        }
    }


    public function inviteUser(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:125|unique:users|unique:invite_users',
            'role' => 'required|string|max:250|exists:roles,name',
        ]);

        $inviteUser = InviteUser::create([
            'email' => $request->email,
            'role' => $request->role,
        ]);
        $data = ['invitationLink' => 'http://127.0.0.1:8000/signup'];
        $emailTemplate = EmailTemplates::find(2);
        Mail::to($inviteUser->email)->send(new GenericMailHandler($emailTemplate, $data));
    }
}
