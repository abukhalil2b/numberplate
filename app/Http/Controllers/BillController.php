<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Item;
use App\Models\Statement;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('bill.create');
    }


    public function store(Request $request)
    {
        return $request->all();

        if (Str::upper($request->required) == 'ROP') {
            $request->validate([
                'ref_num' => 'required',
            ]);
        }

        $request->validate([
            'type' => 'required',
        ]);

        $loggedUser = auth()->user();

        $items = [];

        // add selected  plate into array of items
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

        // dd($items);
        // return $request->all();
        //--ignore if there is no items--
        if (count($items)) {

            $bill = Bill::create([
                'using' => 'rop',
                'required' => $request->required,
                'type' => $request->type,
                'ref_num' => $request->ref_num,
                'plate_num' => $request->plate_num,
                'plate_code' => Str::upper($request->plate_code),
                'payment_method' => $request->payment_method,
                'branch_id' => $loggedUser->id
            ]);

            foreach ($items as $item) {
                
                // store plate 
                Item::create([
                    'cate' => 'plate',
                    'type' => $request->type,
                    'size' => $item['size'],
                    'quantity' => $item['quantity'],
                    'bill_id' => $bill->id,
                    'branch_id' => $loggedUser->id,
                    'status' => 'success'
                ]);

                Stock::create([
                    'instock' => 0,
                    'cate' => 'plate',
                    'type' => $request->type,
                    'size' => $item['size'],
                    'quantity' => -$item['quantity'],
                    'branch_id' => $loggedUser->id,
                    'note' => 'sold',
                ]);
            }

            Statement::create([
                'using' => 'rop',
                'type' => $request->type,
                'size' => $request->sizeForStatement,
                'required' => $request->required,
                'plate_num' => $request->plate_num,
                'plate_code' => Str::upper($request->plate_code),
                'ref_num' => $request->ref_num,
                'branch_id' => $loggedUser->id
            ]);

            if ($request->extra_option != 'no') {
                if ($request->extra_option == 'fixing_plate') {
                    $description = 'fixing plate';
                    $price = 1;
                } else {
                    $description = 'frame with fixing plate';
                    $price = 3;
                }
                // store extra 
                Item::create([
                    'cate' => 'extra',
                    'type' => $request->type,
                    'bill_id' => $bill->id,
                    'branch_id' => $loggedUser->id,
                    'description' => $description,
                    'price' => $price
                ]);
            }
        }

        return back();
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
