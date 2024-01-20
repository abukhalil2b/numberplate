<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helperfunction;
use App\Http\Requests\StoreAdminUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**-- index --*/
    public function index()
    {
        $roles = Role::where('id', '>', 1)->get();

        $users = User::where('profile', 'admin')
            ->whereNot('id', '=', 1)
            ->with('roles')
            ->get();

        return view('admin.user.index', compact('users', 'roles'));
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function store(StoreAdminUserRequest $request)
    {

        // return $request->all();

        //validate if role is exist
        $requestedRole = Role::where('title', $request->role_title)->first();

        if (!$requestedRole) {
            abort(404);
        }

        //generate random password
        $password = Helperfunction::randomPassword();

        $user = User::create([
            'profile' => 'admin',
            'ar_name' => $request->ar_name,
            'en_name' => $request->en_name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'plain_password' => $password,
        ]);

        DB::table('user_role')->insert([
            'user_id' => $user->id,
            'role_id' => $requestedRole->id
        ]);

        return back()->withSuccess('new user is added .!');
    }

    public function edit(User $user)
    {
        //prevent superadmin from update
        if ($user->id == 1) {
            abort(403);
        }

        // system designed to give user many roles. but we give user only one role
        $userRole = DB::table('user_role')
            ->where('user_id', $user->id)
            ->first();

        if (!$userRole) {
            abort(404);
        }

        $role  = Role::where('id', $userRole->role_id)->first();

        if (!$role) {
            abort(404);
        }

        $role_title = $role->title;

        $roles = Role::all();

        return view('admin.user.edit', compact('user', 'roles', 'role_title'));
    }

    public function update(Request $request)
    {


        $request->validate([
            'role_title' => 'required',
            'en_name' => 'required',
            'ar_name' => 'required',
        ]);

        // return $request->all();

        //get new role. validate if role is exist
        $requestedRole = Role::where('title', $request->role_title)->first();

        if (!$requestedRole) {
            abort(404);
        }

        $user = User::where([
            'id' => $request->user_id
        ])->first();

        if (!$user) {
            abort(404);
        }

        //prevent superadmin from update
        if ($user->id == 1) {
            abort(403);
        }

        //search for current role of user.
        $currentRoleOfUser = DB::table('user_role')
            ->select('roles.id', 'roles.title', 'user_role.user_id', 'user_role.role_id')
            ->where('user_id', $user->id)
            ->join('roles', 'user_role.role_id', 'roles.id')
            ->first();

        if (!$currentRoleOfUser) {
            abort(404);
        }

        // check if has already this role.
        if ($requestedRole->title != $currentRoleOfUser->title) {

            DB::table('user_role')
                ->where('user_id', $user->id)
                ->update([
                    'role_id' => $requestedRole->id
                ]);
        }

        //if ar_name has changed
        if ($request->ar_name) {

            $user->ar_name = $request->ar_name;

            $user->save();
        }

        //if en_name has changed
        if ($request->en_name) {

            $user->en_name = $request->en_name;

            $user->save();
        }

        //if password need to be reset
        if ($request->reset_password) {

            //generate random password
            $password = Helperfunction::randomPassword();

            $user->password = Hash::make($password);

            $user->plain_password = $password;

            $user->save();
        }

        return redirect()
            ->route('admin.user.index')
            ->withSuccess('user is updated..!');
    }

    // this function may can be user later
    public function getRoleName($role)
    {
        $name = '';
        switch ($role) {
            case 'superadmin':
                $name = ' إدارة البرنامج | superadmin';
                break;
            case 'director':
                $name = ' المدير العام | General Director';
                break;

            case 'executive':
                $name = ' الرئيس التنفيذي | Executive';
                break;

            case 'chairman':
                $name = ' رئيس مجلس الإدارة | Chairman';
                break;

            case 'accountant':
                $name = ' المحاسب | Accountant';
                break;

            case 'branch_manager':
                $name = ' مدير الفرع Branch Manager';
                break;

            case 'store_keeper':
                $name = ' مسؤل المخزن | Store Keeper';
                break;

            case 'project_manager':
                $name = ' مدير المشروع | Project Manager';
                break;
        }

        return $name;
    }
}
