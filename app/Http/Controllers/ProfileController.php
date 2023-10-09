<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
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
}
