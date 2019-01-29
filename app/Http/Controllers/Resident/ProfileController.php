<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function view()
    {
        $user = auth()->user();
        
                // get the resident's interested events for today
        $activitiesToday    = $user->interestedEvents()->today()->count();
        $openJobs           = $user->maintenance_jobs()->open()->count();
        $openComplaints     = $user->complaints()->open()->count();

        return view('auth.residents.profile.index', compact('user', 'activitiesToday', 'openJobs', 'openComplaints'));
    }
    /**
     * Show the edit view for a resident
     */
    public function edit()
    {
        $user = auth()->user();

        return view('auth.residents.edit', compact('user'));
    }

    /**
     * Process the request to edit a resident's personal information.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        // define the validation messages should the request be invalid
        $messages = [
            'first_name.required'       => 'Please enter your first name',
            'last_name.required'        => 'Please enter your last name',
            'email.required'            => 'Please enter your email',
            'gender.required'           => 'Please select a gender',
            'username.unique'           => 'Sorry, this username is taken. Please use a different username',
            'username.required_without' => 'You must enter a username, or an email address',
            'email.unique'              => 'Sorry, this email is taken. Please use a different email',
            'email.email'               => 'Invalid email address. Please enter in format: john@example.com',
            'email.required_without'    => 'You must enter a username, or an email address',
        ];

        // get the user that is submitting the request
        $user = auth()->user();

        // validate the request
        $validated = $this->validate($request, [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'username'      => [
                'nullable',
                'required_without:email',
                Rule::unique('users')->ignore($user->id)
            ],
            'email'         => [
                'nullable',
                'email',
                'required_without:username',
                Rule::unique('users')->ignore($user->id)
            ],
            'gender'        => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date|date_format:Y-m-d'
        ], $messages);

        // update the user
        $user->update($validated);

        // redirect them back to the profile page
        return redirect()->route('user.profile')->with('success', 'Successfully updated your profile');

    }

    /**
     * Show the change password form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword()
    {
        return view('auth.residents.profile.change-password');
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

        return redirect()->route('user.profile')->with('success', 'Successfully changed your password');
    }
}
