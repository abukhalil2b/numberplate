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
    public function delete(Bill $bill)
    {
        $loggedUser = auth()->user();

        if ($loggedUser->id == $bill->branch_id) {
            Stock::where('bill_id', $bill->id)->delete();

            Statement::where('bill_id', $bill->id)->delete();

            Item::where('bill_id', $bill->id)->delete();

            $bill->delete();
        }


        return redirect()->route('branch.dashboard');
    }

    public function create()
    {
        return view('bill.create');
    }


    public function store(Request $request)
    {

        // return $request->all();

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

            /**-- validate required */
            if ($request->required == 'pair') {
                if (count($items) == 1) {
                    if ($items[0]['quantity'] == 1) {
                        return back();
                    }
                }
            }

            /**-- store bill */
            $bill = Bill::create([
                'using' => 'rop',
                'required' => $request->required,
                'type' => $request->type,
                'ref_num' => $request->ref_num,
                'plate_num' => $request->plate_num,
                'plate_code' => Str::upper($request->plate_code),
                'payment_method' => $request->payment_method,
                'branch_id' => $loggedUser->id,
                'issue_date' => date('Y-m-d'),
                'plate_sold_size' => 'plate is single'
            ]);


            /**-- items */
            foreach ($items as $item) {

                // store plate 
                Item::create([
                    'cate' => 'plate',
                    'required' => $request->required,
                    'type' => $request->type,
                    'size' => $item['size'],
                    'quantity' => $item['quantity'],
                    'bill_id' => $bill->id,
                    'branch_id' => $loggedUser->id,
                    'status' => 'success',
                    'issue_date' => date('Y-m-d')
                ]);

                Stock::create([
                    'instock' => 0,
                    'cate' => 'plate',
                    'type' => $request->type,
                    'size' => $item['size'],
                    'quantity' => -$item['quantity'],
                    'bill_id' => $bill->id,
                    'branch_id' => $loggedUser->id,
                    'note' => 'sold',
                    'issue_date' => date('Y-m-d')
                ]);
            }

            Statement::create([
                'bill_id' => $bill->id,
                'using' => 'rop',
                'type' => $request->type,
                'size' => $request->sizeForStatement,
                'required' => $request->required,
                'plate_num' => $request->plate_num,
                'plate_code' => Str::upper($request->plate_code),
                'ref_num' => $request->ref_num,
                'branch_id' => $loggedUser->id,
                'issue_date' => date('Y-m-d')
            ]);


            $description = '';
            if ($request->extra_option) {
                $buyFramPrice = 0;
                $fixPlate = 0;
                foreach ($request->extra_option as $option) {


                    if ($option == 'buy frame') {

                        if ($request->required == 'single') {
                            $description .= 'buy single frame ';
                            $buyFramPrice = 3;
                        } else {
                            $description .= 'buy pair frame ';
                            $buyFramPrice = 6;
                        }
                    }


                    if ($option == 'fix plate') {
                        if ($request->required == 'single') {
                            $description .= 'fix single plate ';
                            $fixPlate = 0.5;
                        } else {
                            $description .= 'fix pair plate ';
                            $fixPlate = 1;
                        }
                    }

                    $price = $buyFramPrice + $fixPlate;
                }


                // store extra 
                Item::create([
                    'cate' => 'extra',
                    'type' => $request->type,
                    'bill_id' => $bill->id,
                    'branch_id' => $loggedUser->id,
                    'description' => $description,
                    'price' => $price,
                    'issue_date' => date('Y-m-d')
                ]);
            }

            /**-- plate_sold_size */
            $successPlateItemsCount = $bill->successPlateItems()->count();

            if ($bill->required == 'pair') {
                if ($successPlateItemsCount > 1) {
                    $plateSoldSize = 'plate is pair in different size';
                } else {
                    $plateSoldSize = 'plate is pair both are same size';
                }
                $bill->update(['plate_sold_size' => $plateSoldSize]);
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
