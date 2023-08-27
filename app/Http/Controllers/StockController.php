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
    public function index()
    {
        $branches = User::where('profile','branch')->get();

        $stocks = Stock::all();

        return view('stock.index',compact('stocks','branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * size	cate			description
     */
    public function store(Request $request)
    {
        Stock::create([
            'cate'=>'plate',
            
            'size'=>$request->size,
            
            'quantity'=>$request->quantity,
            
            'branch_id'=>$request->branch_id
        ]);

        return back();
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
