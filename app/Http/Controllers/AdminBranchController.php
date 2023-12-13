<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminBranchController extends Controller
{

    public function stockIndex(User $branch)
    {

        $groupedPlateStocks = Stock::where([
            'cate' => 'plate',
            'branch_id' => $branch->id,
        ])->select(DB::raw('sum(quantity) as totalQuantity'), 'size','type')
            ->groupBy('size','type')
            ->get();

        // $loggedUser = auth()->user();

        $branchPlateStocks = Stock::where('cate', 'plate')
            ->latest('id')
            ->where('branch_id', $branch->id)
            ->limit(10)
            ->get();

        return view('admin.branch.stock.index', compact('groupedPlateStocks', 'branch', 'branchPlateStocks'));
    }

    public function branchShow(User $branch)
    {

        return view('admin.branch.show', compact('branch'));
    }

    public function branchCreate()
    {
        $users = User::where('profile', 'branch')
            ->get();

        // return $users;

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
