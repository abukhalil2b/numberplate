<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBillController extends Controller
{

    public function plateIndex(Request $request, User $branch)
    {
        // return $request->all();

        $type = $request->type ? $request->type : 'private';

        $required = $request->required ? $request->required : 'single';

        $date_from = $request->date_from ? $request->date_from : date('Y-m-d');

        $date_to = $request->date_to ? $request->date_to : date('Y-m-d');

        $bills = Bill::where('branch_id', $branch->id)
            ->whereType($type)
            ->whereRequired($required)
            ->whereBetween('created_at', [$date_from, $date_to])//[ ] in future change it to 'issue_date'
            ->latest('id')
            ->get();

        return view('admin.bill.plate.index', compact('branch', 'bills', 'type', 'required', 'date_from', 'date_to'));
    }

    public function extraIndex(Request $request, User $branch)
    {

        $date_from = $request->date_from ? $request->date_from : date('Y-m-d');

        $date_to = $request->date_to ? $request->date_to : date('Y-m-d');

        $items = Item::where('branch_id', $branch->id)
            ->where('cate', 'extra')
            ->whereBetween('created_at', [$date_from, $date_to])
            ->select('description', DB::raw('SUM(price) as totalPrice'), DB::raw('COUNT(id) as quantity'))
            ->groupby('description')
            ->get();

        return view('admin.bill.extra.index', compact('branch', 'items', 'date_from', 'date_to'));
    }
}
