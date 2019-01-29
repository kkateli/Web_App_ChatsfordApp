<?php

namespace App\Http\Controllers\Common;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageComplaintController extends Controller
{
    /**
     * Show the view complaint view.
     *
     * @param $complaint_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($complaint_id)
    {
        $complaint      = Complaint::findOrFail($complaint_id);
        $correspondence = $complaint->entries()->get();

        // need to validate that this complaint record is associated to the resident
        if (auth()->user()->isResident()) {

            abort_unless($complaint->user_id === auth()->id(), 404);

            return view('auth.residents.complaints.view', compact('complaint', 'correspondence'));
        }

        return view('auth.management.complaints.view', compact('complaint', 'correspondence'));
    }

    /**
     * Process the request to add a comment to a complaint.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addCorrespondence(Request $request)
    {
        $messages = [
            'message.required'   => 'Please enter a message'
        ];

        $this->validate($request, [
            'message'           => 'required',
            'complaint_id'      => 'required'
        ], $messages);

        $complaint = Complaint::findOrFail($request->input('complaint_id'));

        $complaint->entries()->create([
            'user_id'   => auth()->id(),
            'comment'   => $request->input('message')
        ]);

        return redirect()->route('common.complaints.view', $complaint)->with('success', 'Successfully added comment');
    }

    /**
     * Resolve a complaint.
     *
     * @param $complaint_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resolve($complaint_id)
    {
        // get the incoming complaint
        $complaint      = Complaint::findOrFail($complaint_id);

        if (auth()->user()->isResident()) {
            // need to validate that this complaint record is associated to the resident
            abort_unless($complaint->user_id === auth()->id(), 404);
        }

        $complaint->resolve();

        return redirect()->route('common.complaints.view', $complaint)->with('success', 'Successfully resolved complaint');
    }

    /**
     * Reopen the complaint.
     *
     * @param $complaint_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reopen($complaint_id)
    {
        // get the incoming complaint
        $complaint      = Complaint::findOrFail($complaint_id);

        if (auth()->user()->isResident()) {
            // need to validate that this complaint record is associated to the resident
            abort_unless($complaint->user_id === auth()->id(), 404);
        }

        $complaint->reopen();

        return redirect()->route('common.complaints.view', $complaint)->with('success', 'Successfully reopened complaint');
    }
}
