<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    /**-- welcome --*/
    public function welcome()
    {
        return view('welcome');
    }

    /**-- admin dashboard --*/
    public function adminDashboard()
    {

        // $loggedUser = auth()->user();

        $latestBills = Bill::whereDate('created_at', date('Y-m-d'))
            ->latest('id')
            ->get();

        return view('admin.dashboard', compact('latestBills'));
    }

    /**-- branch dashboard --*/
    public function branchDashboard()
    {
        $loggedUser = auth()->user();


        //small plate instock
        $smallPlate = Stock::where([
            'cate' => 'plate',
            'branch_id' => $loggedUser->id,
            'size' => 'small'
        ])->selectRaw('sum(quantity) as total')
            ->first();

        //medium plate instock
        $mediumPlate = Stock::where([
            'cate' => 'plate',
            'branch_id' => $loggedUser->id,
            'size' => 'medium'
        ])->selectRaw('sum(quantity) as total')
            ->first();

        //large plate instock
        $largePlate = Stock::where([
            'cate' => 'plate',
            'branch_id' => $loggedUser->id,
            'size' => 'large'
        ])->selectRaw('sum(quantity) as total')
            ->first();

        //largeWithKhanjer plate instock
        $largeWithKhanjerPlate = Stock::where([
            'cate' => 'plate',
            'branch_id' => $loggedUser->id,
            'size' => 'largeWithKhanjer'
        ])->selectRaw('sum(quantity) as total')
            ->first();

        //bike plate instock
        $bikePlate = Stock::where([
            'cate' => 'plate',
            'branch_id' => $loggedUser->id,
            'size' => 'bike'
        ])->selectRaw('sum(quantity) as total')
            ->first();

        // return $smallPlate;

        $latestBills = Bill::whereDate('created_at', date('Y-m-d'))
            ->where('branch_id', $loggedUser->id)
            ->latest('id')
            ->get();

        return view('dashboard', compact(
            'latestBills',
            'smallPlate',
            'mediumPlate',
            'largePlate',
            'largeWithKhanjerPlate',
            'bikePlate'
        ));
    }

    /**-- create branch --*/
    public function createBranch()
    {
        return view('admin.branch.create');
    }

    /**-- store branch --*/
    public function storeBranch(Request $request)
    {

        $user = User::create([
            'profile' => 'branch',
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
