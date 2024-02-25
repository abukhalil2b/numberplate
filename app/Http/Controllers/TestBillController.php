<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Item;
use App\Models\Statement;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestBillController extends Controller
{

    public function storeBill(Request $request)
    {
        $plates = json_decode($request->plates);

        $extras = json_decode($request->extras);

        return $request->all();

        /*---   validation   ---*/
        $request->validate([
            'type' => 'required',
        ]);

        //if no printing job and no extra job don not proceed
        if (count($plates) == 0 && count($extras) == 0) {
            return back();
        }

        if ($request->price_collected_by_rop) {
            $request->validate([
                'ref_num' => 'required',
            ]);
        } else {
            $request->validate([
                'payment_method' => 'required',
                'printing_price' => 'required',
            ]);

            //in case selected plate different size
            if ($request->printing_price > 0) {
                $priceForEachPlate = $request->printing_price / 2;
            }

            if (count($plates) == 2) {
                return back();
            }
        }





        $loggedUser = auth()->user();

        //customer wants only printing job
        //customer wants only extra job
        //customer wants printing and extra job



        /**-- store bill */
        $bill = Bill::create([
            'required' => $request->required,
            'type' => $request->type,
            'ref_num' => $request->ref_num,
            'plate_num' => $request->plate_num,
            'plate_code' => Str::upper($request->plate_code),
            'payment_method' => $request->payment_method,
            'branch_id' => $loggedUser->id,
            'issue_date' => date('Y-m-d')
        ]);

        /**-- store statement */
        if ($request->sizeForStatement) {
            Statement::create([
                'bill_id' => $bill->id,
                'type' => $request->type,
                'size' => $request->sizeForStatement,
                'required' => $request->required,
                'plate_num' => $request->plate_num,
                'plate_code' => Str::upper($request->plate_code),
                'ref_num' => $request->ref_num,
                'branch_id' => $loggedUser->id,
                'issue_date' => date('Y-m-d')
            ]);
        }

        /**-- store plates */
        if (count($plates)) {
            foreach ($plates as $plate) {
                Item::create([
                    'cate' => 'plate',
                    'required' => $request->required,
                    'type' => $request->type,
                    'size' => $plate->size,
                    'quantity' => $plate->quantity,
                    'price' => $plate->price,
                    'bill_id' => $bill->id,
                    'branch_id' => $loggedUser->id,
                    'status' => 'success',
                    'description' => $plate->description,
                    'issue_date' => date('Y-m-d')
                ]);

                Stock::create([
                    'instock' => 0,
                    'cate' => 'plate',
                    'type' => $request->type,
                    'size' => $plate->size,
                    'quantity' => -$plate->quantity,
                    'bill_id' => $bill->id,
                    'branch_id' => $loggedUser->id,
                    'note' => 'sold',
                    'issue_date' => date('Y-m-d')
                ]);
            }
        }



        return back();
    }
}
