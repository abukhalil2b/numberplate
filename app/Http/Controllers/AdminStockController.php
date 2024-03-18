<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helperfunction;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminStockController extends Controller
{

    public function stockIndex(User $branch)
    {

        //get branch permission on plate types
        $branchHasPermissionOnplateTypes = DB::select("SELECT `permissions`.`title` as plate_type FROM `permission_user` JOIN permissions ON `permission_user`.`permission_id` = permissions.id WHERE `permission_user`.`user_id` = ? AND `permissions`.`cate` = 'plate.type';", [$branch->id]);
    
        //modify array
        $branchHasPermissionOnplateTypes = array_map(function ($plate) {
            return $plate->plate_type;
        }, $branchHasPermissionOnplateTypes);

        /*---------------*/
        /* initial values*/
        /*-------------- */
        /*-----Private------*/
        $bikePrivate = 0;
        $smallPrivate = 0;
        $mediumPrivate = 0;
        $largePrivate = 0;
        /*-----Commercial------*/
        $bikeCommercial = 0;
        $largeCommercial = 0;
        $mediumCommercial = 0;
        /*-----Diplomatic------*/
        $bikeDiplomatic = 0;
        $largeDiplomatic = 0;
        $mediumDiplomatic = 0;
        /*-----Temporary------*/
        $bikeTemporary = 0;
        $mediumTemporary = 0;
        /*-----Export------*/
        $mediumExport = 0;
        /*-----Specific------*/
        $bikeSpecific = 0;
        $mediumSpecific = 0;
        $largeSpecific = 0;
        /*-----Learner------*/
        $bikeLearner = 0;
        $mediumLearner = 0;
        /*-----Government ------*/
        $bikeGovernment = 0;
        $mediumGovernment = 0;
        $largeGovernment = 0;
        $largeWithKhanjerGovernment = 0;

        /*-----------*/
        /* private   */
        /*---------- */
        if (in_array('private', $branchHasPermissionOnplateTypes)) {
            /*-- private bike--*/
            $bikePrivate =   Helperfunction::plateCount($branch->id, 'bike', 'private');

            /*-- private small--*/
            $smallPrivate = Helperfunction::plateCount($branch->id, 'small', 'private');

            /*-- private medium--*/
            $mediumPrivate = Helperfunction::plateCount($branch->id, 'medium', 'private');

            /*-- private large--*/
            $largePrivate = Helperfunction::plateCount($branch->id, 'large', 'private');
        }

        /*-----------*/
        /* commercial */
        /*---------- */
        if (in_array('commercial', $branchHasPermissionOnplateTypes)) {
            /*-- commercial bike --*/
            $bikeCommercial =  Helperfunction::plateCount($branch->id, 'bike', 'commercial');

            /*-- commercial large --*/
            $largeCommercial =  Helperfunction::plateCount($branch->id, 'large', 'commercial');

            /*-- commercial medium --*/
            $mediumCommercial =  Helperfunction::plateCount($branch->id, 'medium', 'commercial');
        }

        /*-----------*/
        /* diplomatic */
        /*---------- */
        if (in_array('diplomatic', $branchHasPermissionOnplateTypes)) {
            /*-- diplomatic bike --*/
            $bikeDiplomatic = Helperfunction::plateCount($branch->id, 'bike', 'diplomatic');

            /*-- diplomatic large --*/
            $largeDiplomatic = Helperfunction::plateCount($branch->id, 'large', 'diplomatic');

            /*-- diplomatic medium --*/
            $mediumDiplomatic = Helperfunction::plateCount($branch->id, 'medium', 'diplomatic');
        }

        /*-----------*/
        /* temporary */
        /*---------- */
        if (in_array('temporary', $branchHasPermissionOnplateTypes)) {
            /*-- temporary bike --*/
            $bikeTemporary = Helperfunction::plateCount($branch->id, 'bike', 'temporary');

            /*-- temporary medium --*/
            $mediumTemporary = Helperfunction::plateCount($branch->id, 'medium', 'temporary');
        }

        /*-----------*/
        /* export */
        /*---------- */
        if (in_array('export', $branchHasPermissionOnplateTypes)) {
            /*-- export medium --*/
            $mediumExport = Helperfunction::plateCount($branch->id, 'medium', 'export');
        }

        /*-----------*/
        /* specific */
        /*---------- */
        if (in_array('specific', $branchHasPermissionOnplateTypes)) {
            /*-- specific bike --*/
            $bikeSpecific = Helperfunction::plateCount($branch->id, 'bike', 'specific');

            /*-- specific medium --*/
            $mediumSpecific = Helperfunction::plateCount($branch->id, 'medium', 'specific');

            /*-- specific large --*/
            $largeSpecific = Helperfunction::plateCount($branch->id, 'large', 'specific');
        }

        /*-----------*/
        /* learner */
        /*---------- */
        if (in_array('learner', $branchHasPermissionOnplateTypes)) {
            /*-- learner bike --*/
            $bikeLearner = Helperfunction::plateCount($branch->id, 'bike', 'learner');

            /*-- learner medium --*/
            $mediumLearner = Helperfunction::plateCount($branch->id, 'medium', 'learner');
        }

        /*-----------*/
        /* government */
        /*---------- */
        if (in_array('government', $branchHasPermissionOnplateTypes)) {
            /*-- government bike --*/
            $bikeGovernment = Helperfunction::plateCount($branch->id, 'bike', 'government');

            /*-- government medium --*/
            $mediumGovernment =  Helperfunction::plateCount($branch->id, 'medium', 'government');

            /*-- government large --*/
            $largeGovernment =  Helperfunction::plateCount($branch->id, 'large', 'government');

            /*-- government largeWithKhanjer --*/
            $largeWithKhanjerGovernment = Helperfunction::plateCount($branch->id, 'largeWithKhanjer', 'government');
        }

        $logs = Stock::select('type', 'quantity', 'size', 'stocks.description', 'issue_date')
            ->where([
                'stocks.branch_id' => $branch->id,
                'stocks.note' => 'received'
            ])->join('users', 'stocks.branch_id', '=', 'users.id')
            ->latest('stocks.id')
            ->get();

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
            'branch',
            'logs',
            'branchHasPermissionOnplateTypes'
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

        //store only to main branch

        if ($branch->main_branch != 1) {
            die('we cannot add, this is not main branch');
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

                'main_branch' => 1,

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

                'main_branch' => 1,

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

                'main_branch' => 1,

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

                'main_branch' => 1,

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

                'main_branch' => 1,

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
}
