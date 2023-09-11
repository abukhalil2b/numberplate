<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminBranchController extends Controller
{

    public function branchCreate()
    {
        $users = User::where('profile', 'branch')->get();

        return view('admin.branch.create', compact('users'));
    }


    public function branchStore(Request $request)
    {

        // return $request->all();
        $request->validate([
            'name' => 'required',
            'username' => 'required',
        ]);

        User::create([
            'profile' => 'branch',
            'name' => $request->name,
            'email' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return back();
    }
}
