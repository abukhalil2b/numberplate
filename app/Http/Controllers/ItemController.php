<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Item;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show(Bill $bill)
    {
        $loggedUser = auth()->user();

        //permission
        if ($bill->branch_id != $loggedUser->id) {
            abort(401);
        }

        $plateItems = Item::where(['bill_id' => $bill->id, 'cate' => 'plate'])
            ->get();

        $extraItems = Item::where(['bill_id' => $bill->id, 'cate' => 'extra'])
            ->get();

        return view('item.show', compact('plateItems', 'extraItems', 'bill'));
    }

    public function priceUpdate(Item $item, Request $request)
    {
        $loggedUser = auth()->user();

        $exist = Item::where(['branch_id' => $loggedUser->id, 'id' => $item->id])->first();

        if (!$exist) {
            abort(401);
        }
        $item->update([
            'price' => $request->price
        ]);

        return back();
    }

    public function failedprintStore(Request $request)
    {
        // return $request->all();

        $bill = Bill::findOrFail($request->bill_id);

        $loggedUser = auth()->user();

        //permission
        if ($bill->branch_id != $loggedUser->id) {
            abort(401);
        }

        /*-- single plate --*/
        if ($request->plate_failed == 'single' || $request->plate_failed == 'pair_same_size') {

            $item = Item::findOrFail($request->itemId);

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

            if (!$request->itemIds) {
                abort(404);
            }

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

        $bill = Bill::findOrFail($request->bill_id);

        $loggedUser = auth()->user();

        //permission
        if ($bill->branch_id != $loggedUser->id) {
            abort(401);
        }

        //------ store extra ------//
        if ($request->requiredFixingPlate == 'pair') {

            Item::create([
                'cate' => 'extra',
                'type' => $request->type,
                'bill_id' => $bill->id,
                'branch_id' => $loggedUser->id,
                'description' => 'fix pair plate',
                'price' => '1.000',
                'issue_date' => date('Y-m-d')
            ]);
        }

        if ($request->requiredFixingPlate == 'single') {
            Item::create([
                'cate' => 'extra',
                'type' => $request->type,
                'bill_id' => $bill->id,
                'branch_id' => $loggedUser->id,
                'description' => 'fix single plate',
                'price' => '0.500',
                'issue_date' => date('Y-m-d')
            ]);
        }

        if ($request->requiredBuyFrame == 'pair') {
            Item::create([
                'cate' => 'extra',
                'type' => $request->type,
                'bill_id' => $bill->id,
                'branch_id' => $loggedUser->id,
                'description' => 'buy pair frame',
                'price' => '6.000',
                'issue_date' => date('Y-m-d')
            ]);
        }

        if ($request->requiredBuyFrame == 'single') {
            Item::create([
                'cate' => 'extra',
                'type' => $request->type,
                'bill_id' => $bill->id,
                'branch_id' => $loggedUser->id,
                'description' => 'buy single frame',
                'price' => '3.000',
                'issue_date' => date('Y-m-d')
            ]);
        }
        //------ store extra ------//



        Bill::where('id', $request->bill_id)->update([
            'payment_method' => $request->payment_method
        ]);

        return back();
    }


    public function pritingStore(Request $request)
    {

        return $request->all();
        /*---------------------------//
        
        //--------------------------*/
        $bill = Bill::findOrFail($request->bill_id);

        $loggedUser = auth()->user();

        //permission
        if ($bill->branch_id != $loggedUser->id) {
            abort(401);
        }

        //------ print plate ------//
        if ($request->requiredPrintingPlate > 0) {

            $description = '';

            $price = '0';

            if ($request->requiredPrintingPlate == '1') {
                $description = 'print single bike plate';
                $price = '1.000';
                $required = 'single';
            }

            if ($request->requiredPrintingPlate == '2') {
                $description = 'print pair bike plate';
                $price = '2.000';
                $required = 'pair';
            }

            if ($request->requiredPrintingPlate == '4') {
                $description = 'print single medium plate';
                $price = '4.000';
                $required = 'single';
            }

            if ($request->requiredPrintingPlate == '8') {
                $description = 'print pair medium plate';
                $price = '8.000';
                $required = 'pair';
            }

            if ($request->requiredPrintingPlate == '6') {
                $description = 'print single large plate';
                $price = '6.000';
                $required = 'single';
            }

            if ($request->requiredPrintingPlate == '12') {
                $description = 'print pair large plate';
                $price = '12.000';
                $required = 'pair';
            }

            if ($description != '' && $price != '0') {
                Item::create([
                    'cate' => 'plate',
                    'required' => $required,
                    'type' => $bill->type,
                    'bill_id' => $bill->id,
                    'branch_id' => $loggedUser->id,
                    'description' => $description,
                    'price' =>  $price,
                    'issue_date' => date('Y-m-d')
                ]);
            }
        }
        //------ print plate ------//
        return redirect()->route('item.show',$bill->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
