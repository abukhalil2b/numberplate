<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;

class AdminBillController extends Controller
{

    public function index(User $branch)
    {
        $bills = Bill::where('branch_id',$branch->id)->get();

        return view('admin.bill.index',compact('bills'));
    }



}
