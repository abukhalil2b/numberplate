<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function plateDashboard(Request $request)
    {
        $loggedUser = auth()->user();

        return view('stock.plate.dashboard',compact('loggedUser'));
    }

    public function plateReceived()
    {
        $title = 'plate received';

        $loggedUser = auth()->user();

        $plateStocks = Stock::where(['branch_id' => $loggedUser->id, 'cate' => 'plate', 'note' => 'received'])
            ->latest('id')
            ->paginate(100);

        return view('stock.plate.index', compact('plateStocks', 'loggedUser', 'title'));
    }

    /*
       show available dates
       show list stock based on last date

    */
    public function plateSold()
    {
        // $yearWithMonthList =Stock::selectRaw('DISTINCT year(created_at) year ,month(created_at) as month')
        // ->latest('id')
        // ->get();

        // return $yearWithMonthList;

        $title = 'plate sold';

        $loggedUser = auth()->user();

        $plateStocks = Stock::where(['branch_id' => $loggedUser->id, 'cate' => 'plate', 'note' => 'sold'])
            ->latest('id')
            ->paginate(100);

        return view('stock.plate.index', compact('plateStocks', 'loggedUser', 'title'));

        /*
            note = [received - sold]
            received => add new plate to stock
            sold => plate is sold
        */
    }

    public function plateTransferred()
    {
        $title = 'plate transferred';

        $loggedUser = auth()->user();

        $plateStocks = Stock::where(['branch_id' => $loggedUser->id, 'cate' => 'plate', 'note' => 'transferred'])
            ->latest('id')
            ->paginate(100);

        return view('stock.plate.index', compact('plateStocks', 'loggedUser', 'title'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
