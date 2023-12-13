<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;

class AdminStockController extends Controller
{

    public function show(Stock $stock)
    {
        return view('admin.stock.show', compact('stock'));
    }


    public function store(Request $request)
    {

        // return $request->all();

        $request->validate([
            'type' => 'required',
            'size' => 'required',
            'quantity' => 'required|numeric|gt:0',
            'branch_id' => 'required'
        ]);

        $branch = User::where(['profile' => 'branch', 'id' => $request->branch_id])->first();

        if (!$branch) {
            abort(404);
        }

        Stock::create([
            'instock' => 1,

            'cate' => 'plate',

            'type' => $request->type,

            'size' => $request->size,

            'quantity' => $request->quantity,

            'description' => $request->description,

            'branch_id' => $branch->id,

            'note' => 'received'
        ]);

        return back();
    }


    public function transferCreate(User $fromBranch, $size)
    {
        $branches = User::where('profile', 'branch')
            ->whereNot('id', $fromBranch->id)
            ->get();

        $plateStock = Stock::where([
            'cate' => 'plate',
            'branch_id' => $fromBranch->id,
            'size' => $size
        ])->selectRaw('sum(quantity) as quantity')->first();

        return view('admin.stock.transfer.create', compact('branches', 'fromBranch', 'size', 'plateStock'));
    }



    public function transferStore(Request $request)
    {
        //  return $request->all();

        // return $stock;

        $request->validate([
            'fromBranch_id' => 'required',
            'toBranch_id' => 'required',
            'quantity'=>'required|numeric|gt:0'
        ]);

        $fromBranch = User::where(['profile' => 'branch', 'id' => $request->fromBranch_id])->first();

        if (!$fromBranch) {
            abort(404);
        }

        $toBranch = User::where(['profile' => 'branch', 'id' => $request->toBranch_id])->first();

        if (!$toBranch) {
            abort(404);
        }

        Stock::create([
            'instock' => 0,

            'cate' => 'plate',

            'size' => $request->size,

            'quantity' => -$request->quantity,

            'description' => 'transfered to ' . $toBranch->name,

            'branch_id' => $fromBranch->id,

            'note' => 'transferred'
        ]);


        Stock::create([
            'instock' => 1,

            'cate' => 'plate',

            'size' => $request->size,

            'quantity' => $request->quantity,

            'description' => 'received from ' . $fromBranch->name,

            'branch_id' => $toBranch->id,

            'note' => 'received'
        ]);


        return redirect()->route('admin.branch.stock.index', $fromBranch->id);
    }
}
