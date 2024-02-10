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

            $items = Item::select('description', 'type', DB::raw('sum(price) as totalPrice'), DB::raw('count(id) as count'))
                ->where([
                    'branch_id' => $user->id,
                    'cate' => 'extra',
                ])
                ->whereMonth('issue_date', $month)
                ->groupby('description', 'type')
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

    public function saleHistory($date)
    {
        $loggedUser = auth()->user();

        $items = Item::select('created_at', 'required', 'type', 'size', 'quantity', 'price')
            ->where([
                'branch_id' => $loggedUser->id,
                'cate' => 'plate',
                'status' => 'success'
            ])
            ->whereDate('issue_date', $date)
            ->orderby('required', 'asc')
            ->orderby('type', 'asc')
            ->orderby('size', 'asc')
            ->get();

        return view('profile.sale_history', compact('items', 'date'));
    }
}
