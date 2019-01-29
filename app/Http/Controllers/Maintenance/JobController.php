<?php

namespace App\Http\Controllers\Maintenance;

use App\Models\MaintenanceJob;
use App\Models\MaintenanceType;
use App\Models\User;
use App\Models\Area;
use App\Models\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Show the maintenance user all of the open jobs.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $jobs = $jobs = MaintenanceJob::open()->with('maintenance_type');
        $showType = false;
        $type = null;

        if ($request->filled('type')) {
            $jobs = $jobs->where('type', $request->input('type'));

            // check to see if it exists..
            $type = MaintenanceType::findOrFail($request->input('type'));

            $showType = true;
        }

        $jobs = $jobs->paginate();

        return view('auth.maintenance.jobs.index', compact('jobs', 'showType', 'type'));
    }

    /**
     * View a specific job.
     *
     * @param $job_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($job_id)
    {
        $job = MaintenanceJob::with('submittedBy')->with('maintenance_type')->findOrFail($job_id);

        $correspondence = $job->entries()->get();

        return view('auth.maintenance.jobs.view', compact('job', 'correspondence'));
    }

    /**
     * Add correspondence to a maintenance item.
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
            'message'   => 'required',
            'job_id'    => 'required'
        ], $messages);

        $job = MaintenanceJob::findOrFail($request->input('job_id'));

        $job->entries()->create([
            'user_id'   => auth()->id(),
            'comment'   => $request->input('message')
        ]);

        return redirect()->route('maintenance.job', $job)->with('success', 'Successfully added comment');
    }

    /**
     * Show the add maintenance request form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $types = MaintenanceType::orderBy('name')->get();
        $residents = User::residents()->orderBy(DB::raw('CONCAT(first_name, last_name)'))->get();
        $homes      = Home::get();
        $areas      = Area::get();

        return view('auth.maintenance.jobs.add', compact('types', 'residents', 'homes', 'areas'));
    }

    /**
     * Process the request to add a maintenance job.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(Request $request)
    {
        $messages = [
            'title.required'        => 'Please enter a title',
            'description.required'  => 'Please enter a description',
            'resident_id.required'  => 'Please select a resident'
        ];

        $validated = $this->validate($request, [
            'title'         => 'required',
            'description'   => 'required',
            'resident_id'   => 'required',
            'type'          => 'nullable'
        ], $messages);

        $resident = User::residents()->findOrFail($request->input('resident_id'));

        // get the user's address
        $home_id = optional($request->home)->id;

        $job = MaintenanceJob::create(
            array_merge([
                'user_id'   => $resident->id,
                'home_id'   => $home_id
            ], $validated)
        );

        return redirect()->route('maintenance.job', $job)->with('success', 'Successfully created job');
    }
}
