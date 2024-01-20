<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helperfunction;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;

class AdminStockController extends Controller
{

    public function stockIndex(User $branch)
    {

        // $statistics = DB::select("SELECT `bills`.`type`,`size`,`required`,SUM(`quantity`) as total FROM `items` JOIN `bills` ON `items`.`bill_id` = `bills`.`id` WHERE `cate` = 'plate' AND `items`.`branch_id` = ? AND month(items.created_at) = ? GROUP BY `type`,`required`,`size`;", [$branch->id, $thisMonth]);

        /*-----------*/
        /* private   */
        /*---------- */
        /*-- private bike--*/
        $bikePrivate =   Helperfunction::plateCount($branch->id, 'bike', 'private');

        /*-- private small--*/
        $smallPrivate = Helperfunction::plateCount($branch->id, 'small', 'private');

        /*-- private medium--*/
        $mediumPrivate = Helperfunction::plateCount($branch->id, 'medium', 'private');

        /*-- private large--*/
        $largePrivate = Helperfunction::plateCount($branch->id, 'large', 'private');

        /*-----------*/
        /* commercial */
        /*---------- */
        /*-- commercial bike --*/
        $bikeCommercial =  Helperfunction::plateCount($branch->id, 'bike', 'commercial');

        /*-- commercial large --*/
        $largeCommercial =  Helperfunction::plateCount($branch->id, 'large', 'commercial');

        /*-- commercial medium --*/
        $mediumCommercial =  Helperfunction::plateCount($branch->id, 'medium', 'commercial');

        /*-----------*/
        /* diplomatic */
        /*---------- */
        /*-- diplomatic bike --*/
        $bikeDiplomatic = Helperfunction::plateCount($branch->id, 'bike', 'diplomatic');

        /*-- diplomatic large --*/
        $largeDiplomatic = Helperfunction::plateCount($branch->id, 'large', 'diplomatic');

        /*-- diplomatic medium --*/
        $mediumDiplomatic = Helperfunction::plateCount($branch->id, 'medium', 'diplomatic');

        /*-----------*/
        /* temporary */
        /*---------- */
        /*-- temporary bike --*/
        $bikeTemporary = Helperfunction::plateCount($branch->id, 'bike', 'temporary');

        /*-- temporary medium --*/
        $mediumTemporary = Helperfunction::plateCount($branch->id, 'medium', 'temporary');

        /*-----------*/
        /* export */
        /*---------- */
        /*-- export medium --*/
        $mediumExport = Helperfunction::plateCount($branch->id, 'medium', 'export');

        /*-----------*/
        /* specific */
        /*---------- */
        /*-- specific bike --*/
        $bikeSpecific = Helperfunction::plateCount($branch->id, 'bike', 'specific');

        /*-- specific medium --*/
        $mediumSpecific = Helperfunction::plateCount($branch->id, 'medium', 'specific');

        /*-- specific large --*/
        $largeSpecific = Helperfunction::plateCount($branch->id, 'large', 'specific');


        /*-----------*/
        /* learner */
        /*---------- */
        /*-- learner bike --*/
        $bikeLearner = Helperfunction::plateCount($branch->id, 'bike', 'learner');

        /*-- learner medium --*/
        $mediumLearner = Helperfunction::plateCount($branch->id, 'medium', 'learner');

        /*-----------*/
        /* government */
        /*---------- */
        /*-- government bike --*/
        $bikeGovernment = Helperfunction::plateCount($branch->id, 'bike', 'government');

        /*-- government medium --*/
        $mediumGovernment =  Helperfunction::plateCount($branch->id, 'medium', 'government');

        /*-- government large --*/
        $largeGovernment =  Helperfunction::plateCount($branch->id, 'large', 'government');

        /*-- government largeWithKhanjer --*/
        $largeWithKhanjerGovernment = Helperfunction::plateCount($branch->id, 'largeWithKhanjer', 'government');


        return view('admin.stock.index', compact(
            'bikePrivate',
            'smallPrivate',
            'mediumPrivate',
            'largePrivate',

            'bikeCommercial',
            'mediumCommercial',
            'largeCommercial',

            'bikeDiplomatic',
            'mediumDiplomatic',
            'largeDiplomatic',

            'mediumTemporary',
            'bikeTemporary',

            'mediumExport',

            'bikeSpecific',
            'mediumSpecific',
            'largeSpecific',

            'bikeLearner',
            'mediumLearner',

            'bikeGovernment',
            'mediumGovernment',
            'largeGovernment',
            'largeWithKhanjerGovernment',
            'branch'
        ));
    }

    public function stockCreate(User $branch, $type)
    {
        return view('admin.stock.create', compact('branch', 'type'));
    }

    public function stockStore(Request $request, User $branch, $type)
    {

        // if type not specified threw error.
        if (!in_array($type, ['private', 'commercial', 'diplomatic', 'temporary', 'export', 'specific', 'learner', 'government'])) {
            abort(403);
        }

        // return $request->all();

        $bikeQuantity = $request->bike > 0  ? $request->bike : 0;
        $smallQuantity = $request->small > 0  ? $request->small : 0;
        $mediumQuantity = $request->medium > 0  ? $request->medium : 0;
        $largeQuantity = $request->large > 0  ? $request->large : 0;
        $largeWithKhanjerQuantity = $request->largeWithKhanjer > 0  ? $request->largeWithKhanjer : 0;

        /*-- bike --*/
        if ($bikeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => $type,

                'size' => 'bike',

                'quantity' => $bikeQuantity,

                'description' => $request->description,

                'branch_id' => $branch->id,

                'issue_date' => date('Y-m-d'),

                'note' => 'received'
            ]);
        }

        /*-- small --*/
        if ($smallQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => $type,

                'size' => 'small',

                'quantity' => $smallQuantity,

                'description' => $request->description,

                'branch_id' => $branch->id,

                'issue_date' => date('Y-m-d'),

                'note' => 'received'
            ]);
        }

        /*-- medium --*/
        if ($mediumQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => $type,

                'size' => 'medium',

                'quantity' => $mediumQuantity,

                'description' => $request->description,

                'branch_id' => $branch->id,

                'issue_date' => date('Y-m-d'),

                'note' => 'received'
            ]);
        }


        /*-- large --*/
        if ($largeQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => $type,

                'size' => 'large',

                'quantity' => $largeQuantity,

                'description' => $request->description,

                'branch_id' => $branch->id,

                'issue_date' => date('Y-m-d'),

                'note' => 'received'
            ]);
        }

        /*-- largeWithKhanjer --*/
        if ($largeWithKhanjerQuantity > 0) {
            Stock::create([
                'instock' => 1,

                'cate' => 'plate',

                'type' => $type,

                'size' => 'largeWithKhanjer',

                'quantity' => $largeWithKhanjerQuantity,

                'description' => $request->description,

                'branch_id' => $branch->id,

                'issue_date' => date('Y-m-d'),

                'note' => 'received'
            ]);
        }

        return redirect()->route('admin.stock.index', $branch->id);
    }

    public function show(Stock $stock)
    {
        return view('admin.stock.show', compact('stock'));
    }



    public function transferCreate(User $fromBranch, $type)
    {

        $branches = User::where('profile', 'branch')
            ->whereNot('id', $fromBranch->id)
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

        return view('admin.stock.transfer.create', compact(
            'type',
            'branches',
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
        // get plate from
        //
        // bike
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

        // small
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

        // medium
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

        // large
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

        //
        // store plate to
        //
        // bike
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

        // small
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

        // medium
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

        // large
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

        return redirect()->route('admin.stock.index', $fromBranch->id);
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

        // medium
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

        // large
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

        //
        // store commercial plate tp
        //
        // bike
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

        // medium
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

        // large
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

        return redirect()->route('admin.stock.index', $fromBranch->id);
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


        // medium
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

        // large
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

        //
        // store diplomatic plate to
        //
        // bike
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

        // medium
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

        // large
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

        return redirect()->route('admin.stock.index', $fromBranch->id);
    }

    /*
|--------------------------------------------------------------------------
| temporary
|--------------------------------------------------------------------------
*/
    public function transferTemporaryStore(Request $request)
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
        // get temporary plate from
        //
        // bike
        Stock::create([
            'instock' => 0,

            'cate' => 'plate',

            'type' => 'temporary',

            'size' => 'bike',

            'quantity' => -$request->bikeSizeQuantity,

            'description' => 'transfered to ' . $toBranch->en_name,

            'branch_id' => $fromBranch->id,

            'note' => 'transferred'
        ]);

        // medium
        Stock::create([
            'instock' => 0,

            'cate' => 'plate',

            'type' => 'temporary',

            'size' => 'medium',

            'quantity' => -$request->mediumSizeQuantity,

            'description' => 'transfered to ' . $toBranch->en_name,

            'branch_id' => $fromBranch->id,

            'note' => 'transferred'
        ]);

        //
        // store temporary plate to
        //
        // bike
        Stock::create([
            'instock' => 1,

            'cate' => 'plate',

            'type' => 'temporary',

            'size' => 'bike',

            'quantity' => $request->bikeSizeQuantity,

            'description' => 'received from ' . $fromBranch->en_name,

            'branch_id' => $toBranch->id,

            'note' => 'received'
        ]);

        // medium
        Stock::create([
            'instock' => 1,

            'cate' => 'plate',

            'type' => 'temporary',

            'size' => 'medium',

            'quantity' => $request->mediumSizeQuantity,

            'description' => 'received from ' . $fromBranch->en_name,

            'branch_id' => $toBranch->id,

            'note' => 'received'
        ]);

        return redirect()->route('admin.stock.index', $fromBranch->id);
    }

    /*
|--------------------------------------------------------------------------
| export
|--------------------------------------------------------------------------
*/
    public function transferExportStore(Request $request)
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
        // get export plate from
        //
        // medium
        Stock::create([
            'instock' => 0,

            'cate' => 'plate',

            'type' => 'export',

            'size' => 'medium',

            'quantity' => -$request->mediumSizeQuantity,

            'description' => 'transfered to ' . $toBranch->en_name,

            'branch_id' => $fromBranch->id,

            'note' => 'transferred'
        ]);

        //
        // store export plate to
        //
        // medium
        Stock::create([
            'instock' => 1,

            'cate' => 'plate',

            'type' => 'export',

            'size' => 'medium',

            'quantity' => $request->mediumSizeQuantity,

            'description' => 'received from ' . $fromBranch->en_name,

            'branch_id' => $toBranch->id,

            'note' => 'received'
        ]);

        return redirect()->route('admin.stock.index', $fromBranch->id);
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

        // medium
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

        // large
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

        //
        // store specific plate to
        //
        // bike
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


        // medium
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

        // large
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

        return redirect()->route('admin.stock.index', $fromBranch->id);
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

        // medium
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

        //
        // store learner plate to
        //
        // bike
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

        // medium
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

        return redirect()->route('admin.stock.index', $fromBranch->id);
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

        // medium
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

        // large
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

        // large
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

        //
        // store government plate to
        //
        // bike
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

        // medium
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

        // large
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

        // large with khanjer
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

        return redirect()->route('admin.stock.index', $fromBranch->id);
    }
}
