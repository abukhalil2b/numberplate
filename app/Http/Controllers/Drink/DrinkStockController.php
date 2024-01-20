<?php

namespace App\Http\Controllers\Drink;

use App\Http\Controllers\Controller;
use App\Models\DrinkStock;
use Illuminate\Http\Request;

class DrinkStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drinkStocks = DrinkStock::latest('id')->get();

        $drinkInStocks = $drinkStocks->filter(fn($dring)=>$dring->instock == 1);

        $drinkOutStocks = $drinkStocks->filter(fn($dring)=>$dring->instock == 0);

        return view('admin.drink_stock.index', compact('drinkStocks','drinkInStocks','drinkOutStocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cate' => 'required',
            'instock' => 'required',
            'quantity' => 'required',
        ]);

        //function returns the absolute (positive) value of a number.
        $quantity = abs($request->quantity);

        if ($request->instock == 0) {
            $quantity = -$request->quantity;
        }

        DrinkStock::create([
            'cate' => $request->cate,
            'instock' => $request->instock,
            'quantity' => $quantity,
            'customer_name' => $request->customer_name,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(DrinkStock $drinkStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DrinkStock $drinkStock)
    {
        return view('admin.drink_stock.edit', compact('drinkStock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DrinkStock $drinkStock)
    {
        $request->validate([
            'cate' => 'required',
            'instock' => 'required',
            'quantity' => 'required',
        ]);

        //function returns the absolute (positive) value of a number.
        $quantity = abs($request->quantity);

        if ($request->instock == 0) {
            $quantity = -$request->quantity;
        }

        $drinkStock->update([
            'cate' => $request->cate,
            'instock' => $request->instock,
            'quantity' => $quantity,
            'customer_name' => $request->customer_name,
        ]);

        return redirect()->route('drink_stock.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DrinkStock $drinkStock)
    {
        //
    }
}
