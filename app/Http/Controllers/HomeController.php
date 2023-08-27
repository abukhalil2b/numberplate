<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }

   
    public function dashboard()
    {

        $loggedUser = auth()->user();

        if($loggedUser->profile == 'admin'){

            $bills = Bill::whereDate('created_at',date('Y-m-d'))
            ->latest('id')
            ->get();

            return view('admin.dashboard',compact('bills'));

        }else{

            $bills = Bill::whereDate('created_at',date('Y-m-d'))->where('branch_id',$loggedUser->id)
            ->latest('id')
            ->get();

            return view('dashboard',compact('bills'));
        }

        
        
    }

    public function createBranch()
    {
        return view('admin.branch.create');
    }

    public function storeBranch(Request $request){

        $user = User::create([
            'profile' => 'branch',
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
 		
}
