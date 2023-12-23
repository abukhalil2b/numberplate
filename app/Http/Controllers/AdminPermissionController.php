<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPermissionController extends Controller
{

    public function branchPermissionIndex(User $branch)
    {
        $Permission = Permission::all();

        $userPermissions = DB::table('permission_user')
            ->where(['user_id' => $branch->id])
            ->pluck('permission_id')->toArray();

        $permissions = $Permission->map(function ($permission) use ($userPermissions) {

            $permissionObj['id'] = $permission->id;

            $permissionObj['title'] = $permission->title;

            $permissionObj['has_permission'] = in_array($permission->id, $userPermissions);

            return (object) $permissionObj;
        });

        return view('admin.branch.permission.index', compact('permissions', 'branch'));
    }


    public function branchPermissionUpdate(Request $request, User $branch)
    {

        if ($request->permissionIds) {

            DB::table('permission_user')
                ->where(['user_id' => $branch->id])
                ->delete();

            foreach ($request->permissionIds as $permissionId) {
                DB::table('permission_user')
                    ->insert([
                        'user_id' => $branch->id,
                        'permission_id' => $permissionId
                    ]);
            }
        } else {
            DB::table('permission_user')
                ->where(['user_id' => $branch->id])
                ->delete();
        }

        return back();
    }
}
