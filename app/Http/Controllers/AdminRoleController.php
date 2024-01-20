<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        
        return view('admin.role.index', compact('roles'));
    }


    
}
