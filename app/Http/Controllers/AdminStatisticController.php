<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminStatisticController extends Controller
{


    public function index(Request $request, User $branch)
    {

        //TODO after one year table need to be archive 
        $months = Bill::selectRaw('DISTINCT month(created_at) as month')
            ->latest('id')
            ->pluck('month');

        $thisMonth = $request->month ? $request->month : $months[0];

        $statistics = DB::select("SELECT `bills`.`type`,`size`,`required`,SUM(`quantity`) as total FROM `items` JOIN `bills` ON `items`.`bill_id` = `bills`.`id` WHERE `status` = 'success' AND `cate` = 'plate' AND `items`.`branch_id` = ? AND month(items.created_at) = ? GROUP BY `type`,`required`,`size`;", [$branch->id, $thisMonth]);

        return view('admin.statistic.index', compact('statistics', 'thisMonth', 'branch', 'months'));
    }
}
