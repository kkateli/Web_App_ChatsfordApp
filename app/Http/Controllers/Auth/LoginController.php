<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login view.
     */
    public function login()
    {
        return view('guest.login');
    }

    /**
     * Process the request to login.
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $messages = [
            'username.required' => 'Please enter your username or email address',
            'password.required' => 'Please enter your password'
        ];
        // validate the request - ensure that we have the username and password present
        $this->validate($request, [
            'username'  => 'required',
            'password'  => 'required'
        ], $messages);

        /**
         * Attempt to log in the user firstly with their username, and if this fails - attempt to log them in against
         * their email field.
         */
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {

            // check if the user is active
            if (auth()->user()->isInactive()) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account has been marked inactive. Please contact your administrator if you believe this is a mistake');
            }

            // user has successfully authenticated - redirect the user to the dashboard
            return redirect()->route(auth()->user()->getDashboardRoute());

        } else if (Auth::attempt(['email' => $request->input('username'), 'password' => $request->input('password')])) {


            // check if the user is active
            if (auth()->user()->isInactive()) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account has been marked inactive. Please contact your administrator if you believe this is a mistake');
            }

            // user has successfully authenticated - redirect the user to the dashboard
            return redirect()->route(auth()->user()->getDashboardRoute());

        } else {

            // user has failed authentication - redirect them back to the form
            return redirect()->route('login')->with('error', 'Incorrect email/password combination');
        }
    }

    /**
     * Process the request to log a user out.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // log them out
        Auth::logout();

        // regenerate the session
        $request->session()->regenerate();

        // redirect the user back to the login page
        return redirect()->route('login')->with('success', 'Successfully logged out');
    }
}
