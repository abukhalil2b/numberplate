<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminStatisticController extends Controller
{
    

    public function dashboard()
    {
        $statistics = DB::select("SELECT `cate`,`required`,`type`,`size`,SUM(quantity) as total,`status` FROM `items` LEFT JOIN bills ON bills.id = items.bill_id WHERE cate = 'plate' GROUP BY `required`, `type`, `size`, `status`;");

        return view('admin.statistic.dashboard',compact('statistics'));
    }

   
}
