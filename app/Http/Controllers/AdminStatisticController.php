<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminStatisticController extends Controller
{


    public function dashboard()
    {

        $branches = User::where('profile', 'branch')->get();

        return view('admin.statistic.dashboard', compact('branches'));
    }

    public function index(User $branch)
    {

        //TODO after one year table need to be turncate 
        $months = Bill::selectRaw('DISTINCT month(created_at) as month')
            ->pluck('month');
        
        $thisMonth = $months[0];

        $statistics = DB::select("SELECT `bills`.`type`,`size`,`required`,SUM(`quantity`) as total FROM `items` JOIN `bills` ON `items`.`bill_id` = `bills`.`id` WHERE `status` = 'success' AND `cate` = 'plate' AND `items`.`branch_id` = ? AND month(items.created_at) = ? GROUP BY `required`,`size`;", [$branch->id, $thisMonth]);

        return view('admin.statistic.index', compact('statistics', 'thisMonth', 'branch'));
    }
}
