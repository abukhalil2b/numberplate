<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;

class AdminBillController extends Controller
{

    public function todayIndex(User $branch)
    {
        $todayDate = date('Y-m-d');

        $latestBills = Bill::where('branch_id', $branch->id)
            ->whereDate('created_at', $todayDate)
            ->latest('id')
            ->get();

        return view('admin.bill.index', compact('latestBills', 'todayDate'));
    }

    public function index(User $branch)
    {
        $todayDate = '';
        
        $latestBills = Bill::where('branch_id', $branch->id)
            ->latest('id')
            ->get();

        return view('admin.bill.index', compact('latestBills', 'todayDate'));
    }
}
