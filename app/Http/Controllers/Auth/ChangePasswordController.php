<?php

namespace Ares\Http\Controllers\Auth;

use Ares\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ChangePasswordController extends Controller
{
    use ResetsPasswords;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChangeRequestForm()
    {
        return view('auth.passwords.change');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()
                ->back()
                ->with('error', 'Your current password does not matches with the password you provided. Please try again.');
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) === 0) {
            return redirect()
                ->back()
                ->with('error', 'New Password cannot be same as your current password. Please choose a different password.');
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Password changed successfully!');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setPassword(Request $request)
    {
        $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Password set successfully!');
    }
}
