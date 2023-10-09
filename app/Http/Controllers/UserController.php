<?php

namespace App\Http\Controllers;


use App\Models\User;


class UserController extends Controller
{

    /**-- index --*/
    public function index($role)
    {
        $users = User::where('profile', 'admin')
            ->whereHas('roles', function ($query) use ($role) {
                $query->where('roles.title', $role);
            })
            ->get();
            
        $userRole = $this->getRoleName($role);

        return view('admin.user.index', compact('users', 'userRole'));
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

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
