<?php

namespace App\Http\Controllers\Management;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Show the all residents view.
     */
    public function index()
    {
        $employees = User::employees()->orderByDesc('created_at')->paginate();

        return view('auth.management.employees.index', compact('employees'));
    }

    /**
     * Show the employee.
     *
     * @param $employee_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($employee_id)
    {
        $employee = User::employees()->findOrFail($employee_id);

        return view('auth.management.employees.view', compact('employee'));
    }

    /**
     * Show the add resident view.
     */
    public function add()
    {
        return view('auth.management.employees.add');
    }

    /**
     * Process the request to add an employee.
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
            'type.required'             => 'Please select the type of employee'
        ];

        // validate the request
        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'username'      => 'nullable|unique:users|required_without:email',
            'password'      => 'required',
            'type'          => 'required|in:management,maintenance',
            'email'         => 'nullable|email|unique:users|required_without:username',
            'gender'        => 'nullable|in:male,female,other',
            'date_of_birth_submit' => 'nullable|date|date_format:Y-m-d'
        ], $messages);

        // add the employee
        User::create([
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name'),
            'username'      => $request->input('username') ?: null,
            'email'         => $request->input('email') ?: null,
            'password'      => bcrypt($request->input('password')),
            'gender'        => $request->input('gender') ?: null,
            'date_of_birth' => $request->input('date_of_birth_submit') ?: null,
            'type'          => $request->input('type'),
            'status'        => 1
        ]);

        return redirect()->route('employees')->with('success', 'Successfully added employee');
    }

    /**
     * Show the form to edit an employee.
     *
     * @param $user_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('auth.management.employees.edit', compact('user'));
    }

    /**
     * Process the request to edit an employee.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
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
            'type.required'             => 'Please select the type of employee'
        ];

        $user = User::findOrFail($request->input('user_id'));
        
        // validate the request
        $this->validate($request, [
            'user_id'       => 'required',
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
            'type'          => 'required|in:management,maintenance',
            'gender'        => 'nullable|in:male,female,other',
            'date_of_birth_submit' => 'nullable|date|date_format:Y-m-d',
            'status'        => 'required|in:1,0'
        ], $messages);

        $user->update([
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name'),
            'username'      => $request->input('username'),
            'email'         => $request->input('email'),
            'type'          => $request->input('type'),
            'gender'        => $request->input('gender'),
            'date_of_birth' => $request->input('date_of_birth_submit'),
            'status'        => $request->input('status')
        ]);

        return redirect()->route('employee.view', $user)->with('success', 'Successfully updated employee');
    }
}
