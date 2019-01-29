<?php

namespace App\Http\Controllers\Management;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    /**
     * Show the view.
     *
     * @param $user_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetPassword($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('auth.management.reset_password.reset-password', compact('user'));
    }

    /**
     * Reset the incoming user's password.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postResetPassword(Request $request)
    {
        $messages = [
            'password.required'         => 'Please enter a new password',
            'password_confirm.required' => 'Please confirm the new password',
            'password_confirm.same'     => 'Passwords do not match, please try again'
        ];

        $this->validate($request, [
            'password'          => 'required',
            'password_confirm'  => 'required|same:password',
            'user_id'           => 'required'
        ], $messages);

        $user = User::findOrFail(
            $request->input('user_id')
        );

        $user->update([
            'password'  => bcrypt($request->input('password'))
        ]);

        return redirect()->route($user->getViewUserRoute(), $user)->with('success', 'Successfully changed user\'s password');
    }
}
