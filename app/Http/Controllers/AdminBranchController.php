<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helperfunction;
use App\Http\Requests\BranchStoreRequest;
use App\Models\Stock;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminBranchController extends Controller
{

    public function stockIndex(User $branch)
    {
 
        // $statistics = DB::select("SELECT `bills`.`type`,`size`,`required`,SUM(`quantity`) as total FROM `items` JOIN `bills` ON `items`.`bill_id` = `bills`.`id` WHERE `cate` = 'plate' AND `items`.`branch_id` = ? AND month(items.created_at) = ? GROUP BY `type`,`required`,`size`;", [$branch->id, $thisMonth]);

        $privates = Stock::select('size')->selectRaw('SUM(`quantity`) as total')
        ->where([
            'cate'=>'plate',
            'branch_id'=>$branch->id,
            'type'=>'private',
        ])->groupby('size')
        ->get();


        $commercials =  Stock::select('size')->selectRaw('SUM(`quantity`) as total')
        ->where([
            'cate'=>'plate',
            'branch_id'=>$branch->id,
            'type'=>'commercial',
        ])->groupby('size')
        ->get();

        $diplomatics = Stock::select('size')->selectRaw('SUM(`quantity`) as total')
        ->where([
            'cate'=>'plate',
            'branch_id'=>$branch->id,
            'type'=>'diplomatic',
        ])->groupby('size')
        ->get();

        $temporarys = Stock::select('size')->selectRaw('SUM(`quantity`) as total')
        ->where([
            'cate'=>'plate',
            'branch_id'=>$branch->id,
            'type'=>'temporary',
        ])->groupby('size')
        ->get();

        $exports = Stock::select('size')->selectRaw('SUM(`quantity`) as total')
        ->where([
            'cate'=>'plate',
            'branch_id'=>$branch->id,
            'type'=>'export',
        ])->groupby('size')
        ->get();

        $specifics = Stock::select('size')->selectRaw('SUM(`quantity`) as total')
        ->where([
            'cate'=>'plate',
            'branch_id'=>$branch->id,
            'type'=>'specific',
        ])->groupby('size')
        ->get();

        $learners = Stock::select('size')->selectRaw('SUM(`quantity`) as total')
        ->where([
            'cate'=>'plate',
            'branch_id'=>$branch->id,
            'type'=>'learners',
        ])->groupby('size')
        ->get();

        $governments = Stock::select('size')->selectRaw('SUM(`quantity`) as total')
        ->where([
            'cate'=>'plate',
            'branch_id'=>$branch->id,
            'type'=>'government',
        ])->groupby('size')
        ->get();

        $others = Stock::select('size')->selectRaw('SUM(`quantity`) as total')
        ->where([
            'cate'=>'plate',
            'branch_id'=>$branch->id,
            'type'=>'others',
        ])->groupby('size')
        ->get();

        return view('admin.branch.stock.index', compact('privates', 'commercials', 'diplomatics', 'temporarys', 'exports', 'specifics', 'learners', 'governments', 'others', 'branch'));

    }


    public function branchShow(User $branch)
    {
        $latestBills = Bill::whereDate('created_at', date('Y-m-d'))
            ->with('branch')
            ->latest('id')
            ->get();
        return view('admin.branch.show', compact('branch', 'latestBills'));
    }

    public function branchIndex()
    {
        $branchs = User::where('profile', 'branch')
            ->get();

        // return $users;

        return view('admin.branch.index', compact('branchs'));
    }


    public function branchStore(BranchStoreRequest $request)
    {

        // return $request->all();


        //generate random password
        $password = Helperfunction::randomPassword();

        User::create([
            'profile' => 'branch',
            'name' => $request->branchname,
            'email' => $request->email,
            'password' => Hash::make($password),
            'plain_password' => $password,
        ]);

        return back();
    }
}
