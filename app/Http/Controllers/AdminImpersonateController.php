<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminImpersonateController extends Controller
{


    //impersonate
    public function enableImpersonate(User $user)
    {

        // Guard against administrator impersonate
        if (!$user->isAdministrator()) {
            auth()->user()->setImpersonating($user);
        } else {
            abort(401, 'لايمكن الدخول إلى هذا الحساب');
        }

        return redirect()->route('branch.dashboard');
    }

    public function disableImpersonate()
    {
        auth()->user()->stopImpersonating();

        return redirect()->route('admin.dashboard');
    }

}
