<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminBillController extends Controller
{

    public function index(User $branch)
    {
        $bills = Bill::where('branch_id',$branch->id)->get();

        return view('admin.bill.index',compact('bills'));
    }



}
