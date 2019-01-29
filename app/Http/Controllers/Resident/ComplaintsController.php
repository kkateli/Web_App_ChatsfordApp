<?php

namespace App\Http\Controllers\Resident;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplaintsController extends Controller
{
    /**
     * Show the residents complaints.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $complaints = Complaint::open()->orderByDesc('created_at')->where('user_id', auth()->id())->paginate();

        return view('auth.residents.complaints.index', compact('complaints'));
    }

    /**
     * Show the resolved complaints.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resolved()
    {
        $complaints = Complaint::resolved()->orderByDesc('created_at')->where('user_id', auth()->id())->paginate();

        $closed = true;

        return view('auth.residents.complaints.index', compact('complaints', 'closed'));
    }

    /**
     * Show the form to submit a new complaint.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('auth.residents.complaints.add');
    }

    /**
     * Process the request to add a complaint.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(Request $request)
    {
        $messages = [
            'title.required'        => 'Please enter a subject for your complaint',
            'description.required'  => 'Please enter your complaint'
        ];

        $this->validate($request, [
            'title'         => 'required',
            'description'   => 'required'
        ], $messages);

        Complaint::create([
            'user_id'       => auth()->id(),
            'title'         => $request->input('title'),
            'description'   => $request->input('description'),
            'status'        => 'submitted'
        ]);

        return redirect()->route('resident.complaints')->with('success', 'Successfully submitted complaint');
    }
}
