<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Item;
use App\Models\Statement;
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
        // return $request->all();
        $request->validate([
            'ref_num' => 'required',
            'type' => 'required',
        ]);

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

        // dd($items);
        // return $request->all();
        //--ignore if there is no items--
        if (count($items)) {

            $bill = Bill::create([
                'using' => $request->using,
                'required' => $request->required,
                'type' => $request->type,
                'ref_num' => $request->ref_num,
                'plate_num' => $request->plate_num,
                'plate_code' => Str::upper($request->plate_code),
                'branch_id' => $loggedUser->id
            ]);

            foreach ($items as $item) {

                Item::create([
                    'cate' => 'plate',
                    'size' => $item['size'],
                    'quantity' => $item['quantity'],
                    'bill_id' => $bill->id,
                    'branch_id' => $loggedUser->id,
                    'status' => 'success'
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
