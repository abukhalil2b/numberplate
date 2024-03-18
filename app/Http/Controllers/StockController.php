<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{



    public function transferCreate(User $fromBranch, $type)
    {

        $loggedUser = auth()->user();

        if (!$loggedUser->hasPermission($type)) {
            abort(401);
        }

        $userBranches = User::where('profile', 'branch')
            ->where('branch_id', $loggedUser->id)
            ->get();

        $bikePlateStock = Stock::where([
            'cate' => 'plate',
            'branch_id' => $fromBranch->id,
            'type' => $type,
            'size' => 'bike',
        ])->selectRaw('sum(quantity) as quantity')->first();

        $smallPlateStock = Stock::where([
            'cate' => 'plate',
            'branch_id' => $fromBranch->id,
            'type' => $type,
            'size' => 'small',
        ])->selectRaw('sum(quantity) as quantity')->first();

        $mediumPlateStock = Stock::where([
            'cate' => 'plate',
            'branch_id' => $fromBranch->id,
            'type' => $type,
            'size' => 'medium',
        ])->selectRaw('sum(quantity) as quantity')->first();

        $largePlateStock = Stock::where([
            'cate' => 'plate',
            'branch_id' => $fromBranch->id,
            'type' => $type,
            'size' => 'large',
        ])->selectRaw('sum(quantity) as quantity')->first();

        $largeWithKhanjerPlateStock = Stock::where([
            'cate' => 'plate',
            'branch_id' => $fromBranch->id,
            'type' => $type,
            'size' => 'largeWithKhanjer',
        ])->selectRaw('sum(quantity) as quantity')->first();

        return view('stock.transfer.create', compact(
            'type',
            'userBranches',
            'fromBranch',
            'bikePlateStock',
            'smallPlateStock',
            'mediumPlateStock',
            'largePlateStock',
            'largeWithKhanjerPlateStock'
        ));
    }




    /*
|--------------------------------------------------------------------------
| private
|--------------------------------------------------------------------------
*/
    public function transferPrivateStore(Request $request)
    {
        // return $request->all();

        $request->validate([
            'fromBranch_id' => 'required',
            'toBranch_id' => 'required'
        ]);

        $fromBranch = User::where(['profile' => 'branch', 'id' => $request->fromBranch_id])->first();

        if (!$fromBranch) {
            abort(404);
        }

        $toBranch = User::where(['profile' => 'branch', 'id' => $request->toBranch_id])->first();

        if (!$toBranch) {
            abort(404);
        }

        //
        // get plate from
        //
        // bike
        if ($request->bikeSizeQuantity && $request->bikeSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'private',

                'size' => 'bike',

                'quantity' => -$request->bikeSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        // small
        if ($request->smallSizeQuantity && $request->smallSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'private',

                'size' => 'small',

                'quantity' => -$request->smallSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        // medium
        if ($request->mediumSizeQuantity && $request->mediumSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'private',

                'size' => 'medium',

                'quantity' => -$request->mediumSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        // large
        if ($request->largeSizeQuantity && $request->largeSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'private',

                'size' => 'large',

                'quantity' => -$request->largeSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        //
        // store plate to
        //
        // bike
        if ($request->bikeSizeQuantity && $request->bikeSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'private',

                'size' => 'bike',

                'quantity' => $request->bikeSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        // small
        if ($request->smallSizeQuantity && $request->smallSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'private',

                'size' => 'small',

                'quantity' => $request->smallSizeQuantity,

                'description' => 'received from' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        // medium
        if ($request->mediumSizeQuantity && $request->mediumSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'private',

                'size' => 'medium',

                'quantity' => $request->mediumSizeQuantity,

                'description' => 'received from' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        // large
        if ($request->largeSizeQuantity && $request->largeSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'private',

                'size' => 'large',

                'quantity' => $request->largeSizeQuantity,

                'description' => 'received from' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        return redirect()->route('profile');
    }

    /*
|--------------------------------------------------------------------------
| commercial
|--------------------------------------------------------------------------
*/
    public function transferCommercialStore(Request $request)
    {
        //  return $request->all();

        $request->validate([
            'fromBranch_id' => 'required',
            'toBranch_id' => 'required'
        ]);

        $fromBranch = User::where(['profile' => 'branch', 'id' => $request->fromBranch_id])->first();

        if (!$fromBranch) {
            abort(404);
        }

        $toBranch = User::where(['profile' => 'branch', 'id' => $request->toBranch_id])->first();

        if (!$toBranch) {
            abort(404);
        }

        //
        // get commercial plate from
        //
        // bike
        if ($request->bikeSizeQuantity && $request->bikeSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'commercial',

                'size' => 'bike',

                'quantity' => -$request->bikeSizeQuantity,

                'description' => 'transfered to' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        // medium
        if ($request->mediumSizeQuantity && $request->mediumSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'commercial',

                'size' => 'medium',

                'quantity' => -$request->mediumSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        // large
        if ($request->largeSizeQuantity && $request->largeSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'commercial',

                'size' => 'large',

                'quantity' => -$request->largeSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        //
        // store commercial plate tp
        //
        // bike
        if ($request->bikeSizeQuantity && $request->bikeSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'commercial',

                'size' => 'bike',

                'quantity' => $request->bikeSizeQuantity,

                'description' => 'transfered from' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        // medium
        if ($request->mediumSizeQuantity && $request->mediumSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'commercial',

                'size' => 'medium',

                'quantity' => $request->mediumSizeQuantity,

                'description' => 'transfered from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        // large
        if ($request->largeSizeQuantity && $request->largeSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'commercial',

                'size' => 'large',

                'quantity' => $request->largeSizeQuantity,

                'description' => 'transfered from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        return redirect()->route('profile');
    }

    /*
|--------------------------------------------------------------------------
| diplomatic
|--------------------------------------------------------------------------
*/
    public function transferDiplomaticStore(Request $request)
    {
        //  return $request->all();

        $request->validate([
            'fromBranch_id' => 'required',
            'toBranch_id' => 'required'
        ]);

        $fromBranch = User::where(['profile' => 'branch', 'id' => $request->fromBranch_id])->first();

        if (!$fromBranch) {
            abort(404);
        }

        $toBranch = User::where(['profile' => 'branch', 'id' => $request->toBranch_id])->first();

        if (!$toBranch) {
            abort(404);
        }

        //
        // get diplomatic plate from
        //
        // bike
        if ($request->bikeSizeQuantity && $request->bikeSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'diplomatic',

                'size' => 'bike',

                'quantity' => -$request->bikeSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }


        // medium
        if ($request->mediumSizeQuantity && $request->mediumSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'diplomatic',

                'size' => 'medium',

                'quantity' => -$request->mediumSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        // large
        if ($request->largeSizeQuantity && $request->largeSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'diplomatic',

                'size' => 'large',

                'quantity' => -$request->largeSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        //
        // store diplomatic plate to
        //
        // bike
        if ($request->bikeSizeQuantity && $request->bikeSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'diplomatic',

                'size' => 'bike',

                'quantity' => $request->bikeSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        // medium
        if ($request->mediumSizeQuantity && $request->mediumSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'diplomatic',

                'size' => 'medium',

                'quantity' => $request->mediumSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        // large
        if ($request->largeSizeQuantity && $request->largeSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'diplomatic',

                'size' => 'large',

                'quantity' => $request->largeSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        return redirect()->route('profile');
    }

    /*
|--------------------------------------------------------------------------
| specific
|--------------------------------------------------------------------------
*/
    public function transferSpecificStore(Request $request)
    {
        //  return $request->all();

        $request->validate([
            'fromBranch_id' => 'required',
            'toBranch_id' => 'required'
        ]);

        $fromBranch = User::where(['profile' => 'branch', 'id' => $request->fromBranch_id])->first();

        if (!$fromBranch) {
            abort(404);
        }

        $toBranch = User::where(['profile' => 'branch', 'id' => $request->toBranch_id])->first();

        if (!$toBranch) {
            abort(404);
        }

        //
        // get specific plate from
        //
        // bike
        if ($request->bikeSizeQuantity && $request->bikeSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'specific',

                'size' => 'bike',

                'quantity' => -$request->bikeSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        // medium
        if ($request->mediumSizeQuantity && $request->mediumSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'specific',

                'size' => 'medium',

                'quantity' => -$request->mediumSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        // large
        if ($request->largeSizeQuantity && $request->largeSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'specific',

                'size' => 'large',

                'quantity' => -$request->largeSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        //
        // store specific plate to
        //
        // bike
        if ($request->bikeSizeQuantity && $request->bikeSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'specific',

                'size' => 'bike',

                'quantity' => $request->bikeSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }


        // medium
        if ($request->mediumSizeQuantity && $request->mediumSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'specific',

                'size' => 'medium',

                'quantity' => $request->mediumSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        // large
        if ($request->largeSizeQuantity && $request->largeSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'specific',

                'size' => 'large',

                'quantity' => $request->largeSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        return redirect()->route('profile');
    }

    /*
|--------------------------------------------------------------------------
| learner
|--------------------------------------------------------------------------
*/
    public function transferLearnerStore(Request $request)
    {
        //  return $request->all();

        $request->validate([
            'fromBranch_id' => 'required',
            'toBranch_id' => 'required'
        ]);

        $fromBranch = User::where(['profile' => 'branch', 'id' => $request->fromBranch_id])->first();

        if (!$fromBranch) {
            abort(404);
        }

        $toBranch = User::where(['profile' => 'branch', 'id' => $request->toBranch_id])->first();

        if (!$toBranch) {
            abort(404);
        }

        //
        // get learner plate from
        //
        // bike
        if ($request->bikeSizeQuantity && $request->bikeSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'learner',

                'size' => 'bike',

                'quantity' => -$request->bikeSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        // medium
        if ($request->mediumSizeQuantity && $request->mediumSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'learner',

                'size' => 'medium',

                'quantity' => -$request->mediumSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        //
        // store learner plate to
        //
        // bike
        if ($request->bikeSizeQuantity && $request->bikeSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'learner',

                'size' => 'bike',

                'quantity' => $request->bikeSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        // medium
        if ($request->mediumSizeQuantity && $request->mediumSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'learner',

                'size' => 'medium',

                'quantity' => $request->mediumSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        return redirect()->route('profile');
    }

    /*
|--------------------------------------------------------------------------
| government
|--------------------------------------------------------------------------
*/
    public function transferGovernmentStore(Request $request)
    {
        //  return $request->all();

        $request->validate([
            'fromBranch_id' => 'required',
            'toBranch_id' => 'required'
        ]);

        $fromBranch = User::where(['profile' => 'branch', 'id' => $request->fromBranch_id])->first();

        if (!$fromBranch) {
            abort(404);
        }

        $toBranch = User::where(['profile' => 'branch', 'id' => $request->toBranch_id])->first();

        if (!$toBranch) {
            abort(404);
        }

        //
        // get government plate from
        //
        // bike
        if ($request->bikeSizeQuantity && $request->bikeSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'government',

                'size' => 'bike',

                'quantity' => -$request->bikeSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        // medium
        if ($request->mediumSizeQuantity && $request->mediumSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'government',

                'size' => 'medium',

                'quantity' => -$request->mediumSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        // large
        if ($request->largeSizeQuantity && $request->largeSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'government',

                'size' => 'large',

                'quantity' => -$request->largeSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        // large
        if ($request->largeWithKhanjerSizeQuantity && $request->largeWithKhanjerSizeQuantity > 0) {
            Stock::create([
                'instock' => 0,

                'cate' => 'plate',

                'type' => 'government',

                'size' => 'largeWithKhanjer',

                'quantity' => -$request->largeWithKhanjerSizeQuantity,

                'description' => 'transfered to ' . $toBranch->en_name,

                'branch_id' => $fromBranch->id,

                'note' => 'transferred'
            ]);
        }

        //
        // store government plate to
        //
        // bike
        if ($request->bikeSizeQuantity && $request->bikeSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'government',

                'size' => 'bike',

                'quantity' => $request->bikeSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        // medium
        if ($request->mediumSizeQuantity && $request->mediumSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'government',

                'size' => 'medium',

                'quantity' => $request->mediumSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        // large
        if ($request->largeSizeQuantity && $request->largeSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'government',

                'size' => 'large',

                'quantity' => $request->largeSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        // large with khanjer
        if ($request->largeWithKhanjerSizeQuantity && $request->largeWithKhanjerSizeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => 'government',

                'size' => 'largeWithKhanjer',

                'quantity' => $request->largeWithKhanjerSizeQuantity,

                'description' => 'received from ' . $fromBranch->en_name,

                'branch_id' => $toBranch->id,

                'note' => 'received'
            ]);
        }

        return redirect()->route('profile');
    }
}
