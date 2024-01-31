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

    public function branchPrint()
    {
        $branchs = User::where('profile', 'branch')
            ->get();
        return view('admin.branch.print', compact('branchs'));
    }

    public function branchShow(User $branch)
    {
        $latestBills = Bill::whereDate('created_at', date('Y-m-d'))
            ->where('branch_id', $branch->id)
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
            'ar_name' => $request->ar_branchname,
            'en_name' => $request->en_branchname,
            'email' => $request->email,
            'child_email' => $request->child_email,
            'imei' => $request->imei,
            'password' => Hash::make($password),
            'plain_password' => $password,
        ]);

        return back();
    }


    public function branchEdit(User $branch)
    {
        return view('admin.branch.edit', compact('branch'));
    }

    public function branchUpdate(Request $request, User $branch)
    {
        // return $request->all();
        $request->validate([
            'ar_branchname' => 'required',
            'en_branchname' => 'required',
            'imei' => 'required|numeric',
        ]);

        $branch->update([
            'ar_name' => $request->ar_branchname,
            'en_name' => $request->en_branchname,
            'child_email' => $request->child_email,
            'imei' => $request->imei
        ]);

        if ($request->update_password == 'on') {
            //generate random password
            $password = Helperfunction::randomPassword();

            $branch->update([
                'password' => Hash::make($password),
                'plain_password' => $password,
            ]);
        }

        return redirect()->route('admin.branch.index');
    }
}
