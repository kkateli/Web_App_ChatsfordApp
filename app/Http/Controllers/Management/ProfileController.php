<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Show the logged in user's profile.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();

        return view('auth.management.profile.index', compact('user'));
    }

    /**
     * Show the form to reset the authenticated user's password.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword()
    {
        return view('auth.management.profile.change-password');
    }

    /**
     * Process the request to change a password.
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

        return redirect()->route('profiles')->with('success', 'Successfully changed your password');
    }
}
