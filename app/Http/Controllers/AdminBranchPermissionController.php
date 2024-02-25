<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBranchPermissionController extends Controller
{

    // public function __construct() {


    // }

    public function permissionIndex(User $branch)
    {
        //-- only allow superadmin
        if (auth()->user()->id != 1)
            abort(403);

        //-- Permission
        $Permission = Permission::whereIn('cate', ['plate.size', 'plate.type', 'stock'])
        ->orderby('cate','asc')
        ->get();

        $userPermissions = DB::table('permission_user')
            ->where(['user_id' => $branch->id])
            ->pluck('permission_id')->toArray();

        $permissions = $Permission->map(function ($permission) use ($userPermissions) {

            $permissionObj['cate'] = $permission->cate;

            $permissionObj['id'] = $permission->id;

            $permissionObj['title'] = $permission->title;

            $permissionObj['description'] = $permission->description;

            $permissionObj['has_permission'] = in_array($permission->id, $userPermissions);

            return (object) $permissionObj;
        });

        return view('admin.branch.permission.index', compact('permissions', 'branch'));
    }


    public function permissionUpdate(Request $request, User $branch)
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


    public function manageBranchesIndex(User $user)
    {
        $branches = User::where('profile', 'branch')
            ->where('main_branch', false)
            ->where(fn($q)=>$q->where('branch_id', 0)->orWhere('branch_id', $user->id))
            ->orderby('branch_id', 'asc')
            ->get();

        $branches = $branches->map(function ($b) use ($user) {
            $obj['id'] = $b->id;
            $obj['ar_name'] = $b->ar_name;
            $obj['en_name'] = $b->en_name;
            $obj['selected'] = $b->branch_id == $user->id;
            return (object) $obj;
        });

        return view('admin.branch.manage_permission.index', compact('user', 'branches'));
    }

    public function manageBranchesUpdate(Request $request, User $user)
    {
        if ($request->branchIds) {
            User::where('branch_id', $user->id)->update([
                'branch_id' => 0
            ]);
            User::whereIn('id', $request->branchIds)->update([
                'branch_id' => $user->id
            ]);
        }

        return back();
    }
}
