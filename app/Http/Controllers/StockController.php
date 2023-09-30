<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function plateReceived()
    {
        $loggedUser = auth()->user();

        $plateStocks = Stock::where(['branch_id' => $loggedUser->id, 'cate' => 'plate', 'note' => 'received'])
            ->latest('id')
            ->get();

        return view('stock.plate.index', compact('plateStocks'));
    }

    public function plateSold()
    {
        $loggedUser = auth()->user();

        $plateStocks = Stock::where(['branch_id' => $loggedUser->id, 'cate' => 'plate', 'note' => 'sold'])
            ->latest('id')
            ->get();

        return view('stock.plate.index', compact('plateStocks'));
    }

    public function plateTransferred()
    {
        $loggedUser = auth()->user();

        $plateStocks = Stock::where(['branch_id' => $loggedUser->id, 'cate' => 'plate', 'note' => 'transferred'])
            ->latest('id')
            ->get();

        return view('stock.plate.index', compact('plateStocks'));
    }



    /**
     * size	cate			description
     */
    public function store(Request $request)
    {
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
