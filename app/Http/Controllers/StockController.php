<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function plateReceived()
    {
        $title = 'plate received';

        $loggedUser = auth()->user();

        $plateStocks = Stock::where(['branch_id' => $loggedUser->id, 'cate' => 'plate', 'note' => 'received'])
            ->latest('id')
            ->get();

        return view('stock.plate.index', compact('plateStocks','loggedUser','title'));
    }

    public function plateSold()
    {

        $title = 'plate sold';

        $loggedUser = auth()->user();

        $plateStocks = Stock::where(['branch_id' => $loggedUser->id, 'cate' => 'plate', 'note' => 'sold'])
            ->latest('id')
            ->get();

        return view('stock.plate.index', compact('plateStocks','loggedUser','title'));
    }

    public function plateTransferred()
    {
        $title = 'plate transferred';

        $loggedUser = auth()->user();

        $plateStocks = Stock::where(['branch_id' => $loggedUser->id, 'cate' => 'plate', 'note' => 'transferred'])
            ->latest('id')
            ->get();

        return view('stock.plate.index', compact('plateStocks','loggedUser','title'));
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
