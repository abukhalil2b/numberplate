<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helperfunction;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Item;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(Request $request)
    {
        // return app()->getLocale();
        $user = $request->user();

        if ($user->profile == 'admin') {
            return view('profile.admin_show', compact('user'));
        }

        if ($user->profile == 'branch') {

            /*-- private bike--*/
            $bikePrivate =   Helperfunction::plateCount($user->id, 'bike', 'private');

            /*-- private small--*/
            $smallPrivate = Helperfunction::plateCount($user->id, 'small', 'private');

            /*-- private medium--*/
            $mediumPrivate = Helperfunction::plateCount($user->id, 'medium', 'private');

            /*-- private large--*/
            $largePrivate = Helperfunction::plateCount($user->id, 'large', 'private');

            /*-- commercial bike --*/
            $bikeCommercial =  Helperfunction::plateCount($user->id, 'bike', 'commercial');

            /*-- commercial large --*/
            $largeCommercial =  Helperfunction::plateCount($user->id, 'large', 'commercial');

            /*-- commercial medium --*/
            $mediumCommercial =  Helperfunction::plateCount($user->id, 'medium', 'commercial');

            /*-- diplomatic bike --*/
            $bikeDiplomatic = Helperfunction::plateCount($user->id, 'bike', 'diplomatic');

            /*-- diplomatic large --*/
            $largeDiplomatic = Helperfunction::plateCount($user->id, 'large', 'diplomatic');

            /*-- diplomatic medium --*/
            $mediumDiplomatic = Helperfunction::plateCount($user->id, 'medium', 'diplomatic');

            /*-- temporary bike --*/
            $bikeTemporary = Helperfunction::plateCount($user->id, 'bike', 'temporary');

            /*-- temporary medium --*/
            $mediumTemporary = Helperfunction::plateCount($user->id, 'medium', 'temporary');

            /*-- export medium --*/
            $mediumExport = Helperfunction::plateCount($user->id, 'medium', 'export');

            /*-- specific bike --*/
            $bikeSpecific = Helperfunction::plateCount($user->id, 'bike', 'specific');

            /*-- specific medium --*/
            $mediumSpecific = Helperfunction::plateCount($user->id, 'medium', 'specific');

            /*-- specific large --*/
            $largeSpecific = Helperfunction::plateCount($user->id, 'large', 'specific');

            /*-- learner bike --*/
            $bikeLearner = Helperfunction::plateCount($user->id, 'bike', 'learner');

            /*-- learner medium --*/
            $mediumLearner = Helperfunction::plateCount($user->id, 'medium', 'learner');

            /*-- government bike --*/
            $bikeGovernment = Helperfunction::plateCount($user->id, 'bike', 'government');

            /*-- government medium --*/
            $mediumGovernment =  Helperfunction::plateCount($user->id, 'medium', 'government');

            /*-- government large --*/
            $largeGovernment =  Helperfunction::plateCount($user->id, 'large', 'government');

            /*-- government largeWithKhanjer --*/
            $largeWithKhanjerGovernment = Helperfunction::plateCount($user->id, 'largeWithKhanjer', 'government');

            $month = date('m');

            $items = Item::select('type', 'description', DB::raw('sum(price) as totalPrice'), DB::raw('count(id) as count'))
                ->where([
                    'branch_id' => $user->id,
                    'cate' => 'extra',
                ])
                ->whereMonth('issue_date', $month)
                ->groupby('type', 'description')
                ->get();
            // return $items;
            $branch = $user;

            $issueDates = DB::select("SELECT DISTINCT issue_date FROM `items` WHERE branch_id = ?; ", [$user->id]);

            return view('profile.branch_show', compact(
                'issueDates',
                'month',
                'items',
                'branch',
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
                'largeWithKhanjerGovernment'
            ));
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function localizationStore($local)
    {
        if (!in_array($local, ['en', 'ar'])) {
            abort(400);
        }

        session(['localization' => $local]);

        $loggedUser = auth()->user();

        if ($loggedUser->profile == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($loggedUser->profile == 'branch') {
            return redirect()->route('branch.dashboard');
        }
    }

    public function plateSaleHistory($date)
    {
        $loggedUser = auth()->user();

        $items = Item::select('bills.plate_num', 'bills.plate_code', 'items.created_at', 'items.required', 'items.type', 'items.size', 'items.quantity', 'items.price')
            ->join('bills', 'items.bill_id', 'bills.id')
            ->where([
                'items.branch_id' => $loggedUser->id,
                'items.cate' => 'plate',
                'items.status' => 'success'
            ])
            ->whereDate('items.issue_date', $date)
            ->orderby('items.id', 'desc')
            ->get();

        $items = $items->map(function ($q) {
            $itemObj['plate_num'] = $q->plate_num;
            $itemObj['plate_code'] = $q->plate_code;
            $itemObj['created_at'] = $q->created_at;
            $itemObj['required'] = $q->required;
            $itemObj['type'] = $q->type;
            $itemObj['size'] = $q->size;
            $itemObj['quantity'] = $q->quantity;
            $itemObj['price'] = $q->price;

            if ($q->required == 'pair' && $q->quantity == 1) {
                $itemObj['note'] = 'diffrent size';
            } else {
                $itemObj['note'] = '';
            }

            return (object) $itemObj;
        });

        return view('profile.plate_sale_history', compact('items', 'date'));
    }

    public function extraSaleHistory($date)
    {
        $loggedUser = auth()->user();

        $items = Item::select('items.created_at', 'bills.plate_num', 'bills.plate_code', 'items.type', 'items.description', 'items.price')
            ->join('bills', 'items.bill_id', 'bills.id')
            ->where([
                'items.branch_id' => $loggedUser->id,
                'items.cate' => 'extra'
            ])
            ->whereDate('items.issue_date', $date)
            ->orderby('items.id', 'desc')
            ->get();

        return view('profile.extra_sale_history', compact('items', 'date'));
    }
}
