<?php

namespace App\Http\Controllers\Management;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplaintsController extends Controller
{
    /**
     * Show all of the complaints.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $complaints = Complaint::open()->orderByDesc('created_at')->paginate();

        return view('auth.management.complaints.index', compact('complaints'));
    }

    /**
     * Show all of the resolved complaints.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resolved()
    {
        $complaints = Complaint::resolved()->orderByDesc('created_at')->paginate();

        $closed = true;

        return view('auth.management.complaints.index', compact('complaints', 'closed'));
    }

    /**
     * Show the view to delete a complaint.
     *
     * @param $complaint_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($complaint_id)
    {
        $complaint = Complaint::findOrFail($complaint_id);

        return view('auth.management.complaints.delete', compact('complaint'));
    }

    /**
     * Process the request to delete the complaint.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete(Request $request)
    {
        $this->validate($request, [
            'complaint_id'   => 'required'
        ]);

        $complaint = Complaint::findOrFail($request->input('complaint_id'));

        $complaint->delete();

        return redirect()->route('management.complaints')->with('success', 'Successfully deleted complaint');
    }
}
