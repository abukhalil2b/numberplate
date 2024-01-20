<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPermissionRoleController extends Controller
{

    public function index(Role $role)
    {
        $permissions = Permission::whereNotIn('cate',['plate.size','plate.type'])->get();

        $rolePermissionIds = DB::table('permission_role')
            ->where('role_id', $role->id)
            ->pluck('permission_id')
            ->toArray();

        $rolePermissions = $permissions->map(function ($p) use ($rolePermissionIds) {

            $permissionObj['id'] = $p->id;
            $permissionObj['title'] = $p->title;
            $permissionObj['selected'] = in_array($p->id, $rolePermissionIds);
            return (object) $permissionObj;
        });

        return view('admin.permission_role.index', compact('rolePermissions', 'role'));
    }

    public function update(Request $request, Role $role)
    {


        DB::table('permission_role')
            ->where('role_id', $role->id)
            ->delete();
            
        if ($request->permissionIds) {

            foreach ($request->permissionIds as $id) {
                DB::table('permission_role')
                    ->insert([
                        'role_id' => $role->id,
                        'permission_id' => $id
                    ]);
            }
        }

        return back();
    }
}
