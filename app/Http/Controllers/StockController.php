<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function plateIndex()
    {
        $loggedUser = auth()->user();

        if ($loggedUser->profile == 'admin') {
            
            $plateStocks = Stock::where('cate', 'plate')
            ->latest('id')
            ->get();

        } else {

            $plateStocks = Stock::where(['branch_id' => $loggedUser->id, 'cate' => 'plate'])
            ->latest('id')
            ->get();
        }


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
