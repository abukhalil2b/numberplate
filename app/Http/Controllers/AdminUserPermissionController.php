<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserPermissionController extends Controller
{


    public function roleWithPermissions(User $user)
    {
        //-- only allow superadmin
        if (auth()->user()->id != 1)
            abort(401);

        //-- User Roles
        $roleWithPermissions = $user->roles()->with('permissions')->get();

        return view('admin.user.role_with_permissions', compact('roleWithPermissions', 'user'));
    }


    public function permissionUpdate(Request $request, User $branch)
    {
    }
}
