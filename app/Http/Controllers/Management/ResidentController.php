<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Home;
use App\Models\MaintenanceJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ResidentController extends Controller
{
    /**
     * Show the all residents view.
     */
    public function index()
    {
        $residents = User::residents()->orderByDesc('created_at')->paginate();

        return view('auth.management.residents.index', compact('residents'));
    }

    /**
     * Show the add resident view.
     */
    public function add()
    {
        $homes = Home::orderBy('name')->get();

        return view('auth.management.residents.add', compact('homes'));
    }

    /**
     * Process the request to add a resident.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(Request $request)
    {
        // define the validation messages should the request be invalid
        $messages = [
            'first_name.required'       => 'Please enter a first name',
            'last_name.required'        => 'Please enter a last name',
            'email.required'            => 'Please enter an email',
            'gender.required'           => 'Please select a gender',
            'username.unique'           => 'Sorry, this username is taken. Please use a different username',
            'username.required_without' => 'You must enter a username, or an email address',
            'email.unique'              => 'Sorry, this email is taken. Please use a different email',
            'email.email'               => 'Invalid email address. Please enter in format: john@example.com',
            'email.required_without'    => 'You must enter a username, or an email address',
        ];

        // validate the request
        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'username'      => 'nullable|unique:users|required_without:email',
            'password'      => 'required',
            'email'         => 'nullable|email|unique:users|required_without:username',
            'gender'        => 'required|in:male,female,other',
            'date_of_birth_submit' => 'nullable|date|date_format:Y-m-d',
            'home_id'       => 'nullable'
        ], $messages);

        // add the resident
        User::create([
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name'),
            'username'      => $request->input('username') ?: null,
            'email'         => $request->input('email') ?: null,
            'password'      => bcrypt($request->input('password')),
            'gender'        => $request->input('gender') ?: null,
            'type'          => 'resident',
            'date_of_birth' => $request->input('date_of_birth_submit') ?: null,
            'status'        => 1,
            'home_id'       => $request->input('home_id') ?: null
        ]);

        return redirect()->route('residents')->with('success', 'Successfully added resident');
    }

    /**
     * Show the edit resident view.
     *
     * @param $user_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($user_id)
    {
        $user = User::residents()->findOrFail($user_id);

        $homes = Home::all();

        return view('auth.management.residents.edit', compact('user', 'homes'));
    }

    /**
     * Process the request to edit a resident.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        // define the validation messages should the request be invalid
        $messages = [
            'first_name.required' => 'Please enter your first name',
            'last_name.required' => 'Please enter your last name',
            'email.required' => 'Please enter your email',
            'gender.required' => 'Please select a gender',
            'username.unique' => 'Sorry, this username is taken. Please use a different username',
            'username.required_without' => 'You must enter a username, or an email address',
            'email.unique' => 'Sorry, this email is taken. Please use a different email',
            'email.email' => 'Invalid email address. Please enter in format: john@example.com',
            'email.required_without' => 'You must enter a username, or an email address',
        ];

        // get the user
        $user = User::findOrFail($request->input('user_id'));

        // validate the request
        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'username' => [
                'nullable',
                'required_without:email',
                Rule::unique('users')->ignore($user->id)
            ],
            'email' => [
                'nullable',
                'email',
                'required_without:username',
                Rule::unique('users')->ignore($user->id)
            ],
            'gender'        => 'required|in:male,female,other',
            'date_of_birth_submit' => 'nullable|date|date_format:Y-m-d',
            'status'        => 'required|in:1,0',
            'home_id'       => 'nullable'
        ], $messages);

        $user->update([
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name'),
            'username'      => $request->input('username'),
            'email'         => $request->input('email'),
            'gender'        => $request->input('gender'),
            'date_of_birth' => $request->input('date_of_birth_submit'),
            'status'        => $request->input('status')
        ]);

        // redirect them back to the profile page
        return redirect()->route('resident.view', $user)->with('success', 'Successfully updated resident\'s profile');
    }

    /**
     * View a given resident.
     *
     * @param $resident_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($resident_id)
    {
        $resident = User::residents()->findOrFail($resident_id);

        // jobs the user has submitted
        $jobs     = MaintenanceJob::where('user_id', $resident_id)->with('submittedBy')->orderByDesc('created_at')->paginate();

        // complaints the user has submitted
        $complaints = Complaint::where('user_id', $resident_id)->with('submittedBy')->orderByDesc('created_at')->paginate();

        return view('auth.management.residents.view', compact('resident', 'jobs', 'complaints'));
    }

    /**
     * Return residents for API lookups.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lookup(Request $request)
    {
        $residents = User::residents()->where(DB::raw('CONCAT(first_name, last_name)'), 'LIKE', '%' . $request->input('term') . '%')->get();

        $residents->transform(function ($resident) {
            $name = $resident->name();
            return [
                'id'        => $resident->id,
                'text'      => $name
            ];
        });

        return response()->json([
            'valid'     => true,
            'results'   => $residents
        ]);
    }
}
