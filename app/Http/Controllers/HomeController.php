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
        ->with(['branch','plateItems'])
            ->latest('id')
            ->get();

        return view('admin.dashboard', compact('latestBills'));
    }

    /**-- branch dashboard --*/
    public function branchDashboard()
    {
        $loggedUser = auth()->user();

        $latestBills = Bill::whereDate('created_at', date('Y-m-d'))
            ->where('branch_id', $loggedUser->id)
            ->latest('id')
            ->get();

        return view('dashboard', compact(
            'latestBills'
        ));
    }

}
