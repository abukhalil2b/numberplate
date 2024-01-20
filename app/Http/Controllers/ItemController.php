<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Item;
use App\Models\Stock;
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

        return view('item.index', compact('plateItems', 'extraItems', 'bill'));
    }

    public function failedprintStore(Request $request)
    {
        // return $request->all();

        $bill = Bill::findOrFail($request->bill_id);

        $loggedUser = auth()->user();

        /*-- single plate --*/
        if ($request->plate_failed == 'single' || $request->plate_failed == 'pair_same_size') {

            $item = Item::find($request->itemId);

            if (!$item) {
                abort(404);
            }

            /*-- item --*/
            Item::create([
                'cate' => 'plate',
                'type' => $bill->type,
                'size' => $item->size,
                'quantity' => 1,
                'bill_id' => $bill->id,
                'branch_id' => $loggedUser->id,
                'status' => 'failed',
                'issue_date' => date('Y-m-d')
            ]);

            /*-- stock --*/
            Stock::create([
                'cate' => 'plate',
                'instock' => 0,
                'type' => $bill->type,
                'size' => $item->size,
                'quantity' => -1,
                'bill_id' => $request->bill_id,
                'branch_id' => $loggedUser->id,
                'description' => 'print is failed',
                'note' => 'failed',
                'issue_date' => date('Y-m-d')
            ]);
        }

        /*-- pair plate in different size--*/
        if ($request->plate_failed == 'pair_in_different_size') {

            $items = Item::whereIn('id', $request->itemIds)
                ->where(['cate' => 'plate', 'status' => 'success'])
                ->get();
            // return $items;
            if (count($items) == 0) {
                abort(404);
            }

            foreach ($items as $item) {

                /*-- item --*/
                Item::create([
                    'cate' => 'plate',
                    'type' => $bill->type,
                    'size' => $item->size,
                    'quantity' => 1,
                    'bill_id' => $request->bill_id,
                    'branch_id' => $loggedUser->id,
                    'status' => 'failed',
                    'issue_date' => date('Y-m-d')
                ]);

                /*-- stock --*/
                Stock::create([
                    'cate' => 'plate',
                    'instock' => 0,
                    'type' => $bill->type,
                    'size' => $item->size,
                    'quantity' => -1,
                    'branch_id' => $loggedUser->id,
                    'description' => 'print is failed',
                    'note' => 'failed',
                    'issue_date' => date('Y-m-d')
                ]);
            }
        }

        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function extraStore(Request $request)
    {

        $request->validate([
            'payment_method' => 'required'
        ]);
        // return $request->all();

        $loggedUser = auth()->user();

        $price = 1;

        $description = 'fixing plate';

        if ($request->extra_option == 'frame_with_fixing_plate') {

            $price = 3;

            $description = 'frame with fixing plate';
        }

        Item::create([
            'cate' => 'extra',
            'size' => null,
            'description' => $description,
            'price' => $price,
            'bill_id' => $request->bill_id,
            'branch_id' => $loggedUser->id,
            'status' => null,
            'issue_date' => date('Y-m-d')
        ]);

        Bill::where('id', $request->bill_id)->update([
            'payment_method' => $request->payment_method
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
