<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Show the change password form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword()
    {
        return view('auth.maintenance.profile.change-password');
    }

    /**
     * Process the request to change a user's password.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postChangePassword(Request $request)
    {
        $messages = [
            'password.required'         => 'Please enter a new password',
            'password_confirm.required' => 'Please confirm your new password',
            'password_confirm.same'     => 'Passwords do not match. Please try again'
        ];

        $this->validate($request, [
            'password'          => 'required',
            'password_confirm'  => 'required|same:password'
        ], $messages);

        auth()->user()->update([
            'password'  => bcrypt($request->input('password'))
        ]);

        return redirect()->route('maintenance.dashboard')->with('success', 'Successfully changed your password');
    }
}
