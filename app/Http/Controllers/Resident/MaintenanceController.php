<?php

namespace App\Http\Controllers\Resident;

use App\Models\MaintenanceJob;
use App\Models\MaintenanceType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaintenanceController extends Controller
{
    /**
     * Show the resident's open maintenance jobs.
     */
    public function index()
    {
        // user's open jobs
        $jobs = MaintenanceJob::open()->where('user_id', auth()->id())
                                ->with('maintenance_type')
                                ->paginate();

        return view('auth.residents.maintenance.index', compact('jobs'));
    }

    public function view($job_id)
    {
        $job = MaintenanceJob::where('user_id', auth()->id())
                                ->with('maintenance_type')
                                ->findOrFail($job_id);

        $correspondence = $job->entries()->get();

        return view('auth.residents.maintenance.view', compact('job', 'correspondence'));
    }

    /**
     * Show the form to add a job.
     */
    public function add()
    {
        $types = MaintenanceType::orderBy('name')->get();

        return view('auth.residents.maintenance.add', compact('types'));
    }

    /**
     * Process request to add a maintenance job.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(Request $request)
    {
        $messages = [
            'title.required'        => 'Please enter a title',
            'description.required'  => 'Please enter a description'
        ];

        $validated = $this->validate($request, [
            'title'         => 'required',
            'description'   => 'required',
            'type'          => 'nullable'
        ], $messages);

        // get the user's address
        $home_id = optional(auth()->user()->home)->id;

        MaintenanceJob::create(
            array_merge([
                'user_id'   => auth()->id(),
                'home_id'   => $home_id
            ], $validated)
        );

        return redirect()->route('resident.jobs')->with('success', 'Your maintenance request has been submitted successfully');
    }
}
