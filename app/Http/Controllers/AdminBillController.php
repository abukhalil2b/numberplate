<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;

class AdminBillController extends Controller
{

    public function index(User $branch)
    {
        $latestBills = Bill::where('branch_id',$branch->id)
        ->latest('id')
        ->get();
        
        return view('admin.bill.index',compact('latestBills'));
    }



}
