<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Bill $bill)
    {
        $plateItems = Item::where(['bill_id' => $bill->id, 'cate' => 'plate'])->get();

        $extraItems = Item::where(['bill_id' => $bill->id, 'cate' => 'extra'])->get();

        return view('item.index', compact('plateItems','extraItems','bill'));
    }

    public function failedprintStore(Request $request)
    {

        $loggedUser = auth()->user();

        $items = [];

        if ($request->small > 0) {

            array_push($items, ['size' => 'small', 'quantity' => $request->small]);
        }

        if ($request->medium > 0) {

            array_push($items, ['size' => 'medium', 'quantity' => $request->medium]);
        }

        if ($request->large > 0) {

            array_push($items, ['size' => 'large', 'quantity' => $request->large]);
        }

        if ($request->largeWithKhanjer > 0) {

            array_push($items, ['size' => 'largeWithKhanjer', 'quantity' => $request->largeWithKhanjer]);
        }

        if ($request->bike > 0) {

            array_push($items, ['size' => 'bike', 'quantity' => $request->bike]);
        }


        foreach ($items as $item) {

            Item::create([
                'cate' => 'plate',
                'size' => $item['size'],
                'quantity' => $item['quantity'],
                'bill_id' => $request->bill_id,
                'branch_id' => $loggedUser->id,
                'status' => 'failed'
            ]);
        }

        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function extraStore(Request $request)
    {
        // return $request->all();

        $loggedUser = auth()->user();

        Item::create([
            'cate' => 'extra',
            'size' => null,
            'description' => $request->description,
            'price' => $request->price,
            'bill_id' => $request->bill_id,
            'branch_id' => $loggedUser->id,
            'status' => null
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
