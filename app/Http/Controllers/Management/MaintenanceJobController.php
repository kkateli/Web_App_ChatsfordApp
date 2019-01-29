<?php

namespace App\Http\Controllers\Management;

use App\Models\Announcement;
use App\Models\Area;
use App\Models\Home;
use App\Models\MaintenanceJob;
use App\Models\MaintenanceType;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MaintenanceJobController extends Controller
{
    /**
     * Show the open jobs view.
     */
    public function index()
    {
        $jobs = MaintenanceJob::open()->orderByDesc('created_at')->paginate();

        return view('auth.management.maintenance.index', compact('jobs'));
    }

    /**
     * Allow management to add a maintenance job.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $types      = MaintenanceType::orderBy('name')->get();
        $residents  = User::residents()->orderBy(DB::raw('CONCAT(first_name, last_name)'))->get();
        $homes      = Home::get();
        $areas      = Area::get();

        return view('auth.management.maintenance.add', compact('types', 'residents', 'homes', 'areas'));
    }

    /**
     * Process the request to add a job.
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
            'resident_id'   => 'nullable',
            'home_id'       => 'nullable',
            'area_id'       => 'nullable',
            'type'          => 'nullable'
        ], $messages);

        if ($request->filled('resident_id')) {
            $resident = User::residents()->findOrFail($request->input('resident_id'));
        } else {
            $resident = null;
        }

        if (! $request->filled('home_id')) {
            // get the user's address
            $home_id = optional($request->home)->id;
        } else {
            $home_id = $request->input('home_id');
        }

        if ($request->filled('area_id')) {
            $area_id = $request->input('area_id');
        } else {
            $area_id = null;
        }

        $job = MaintenanceJob::create(
            array_merge([
                'user_id'   => optional($resident)->id,
                'home_id'   => $home_id,
                'area_id'   => $area_id
            ], $validated)
        );

        if (auth()->user()->isMaintenance()) {
            return redirect()->route('maintenance.job', $job)->with('success', 'Successfully created job');
        }

        return redirect()->route('job', $job)->with('success', 'Successfully created job');
    }

    /**
     * View a specific job.
     *
     * @param $job_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($job_id)
    {
        $job = MaintenanceJob::with('submittedBy')->findOrFail($job_id);

        $correspondence = $job->entries()->with('user')->get();

        return view('auth.management.maintenance.view', compact('job', 'correspondence'));
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

        return redirect()->route('job', $job)->with('success', 'Successfully added comment');
    }

    /**
     * Mark the given job as in-progress.
     *
     * @param $job_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markInProgress($job_id)
    {
        $job = MaintenanceJob::findOrFail($job_id);

        $job->update([
            'status'    => 'in_progress'
        ]);

        $job->entries()->create([
            'user_id'           => auth()->id(),
            'status_changed'    => 'in_progress'
        ]);

        if (auth()->user()->isMaintenance()) {
            return redirect()->route('maintenance.job', $job)->with('success', 'Successfully marked job as in progress');
        } else {
            return redirect()->route('job', $job)->with('success', 'Successfully marked job as in progress');
        }
    }

    /**
     * Close the job.
     *
     * @param $job_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completed($job_id)
    {
        $job = MaintenanceJob::findOrFail($job_id);

        $job->update([
            'status'    => 'completed'
        ]);

        $job->entries()->create([
            'user_id'           => auth()->id(),
            'status_changed'    => 'completed'
        ]);

        if (auth()->user()->isMaintenance()) {
            return redirect()->route('maintenance.job', $job)->with('success', 'Successfully marked job as completed');
        } else {
            return redirect()->route('job', $job)->with('success', 'Successfully marked job as completed');
        }
    }

    /**
     * Reopen the job.
     *
     * @param $job_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reopen($job_id)
    {
        $job = MaintenanceJob::findOrFail($job_id);

        $job->update([
            'status'    => 'submitted'
        ]);

        $job->entries()->create([
            'user_id'           => auth()->id(),
            'status_changed'    => 'submitted'
        ]);

        if (auth()->user()->isMaintenance()) {
            return redirect()->route('maintenance.job', $job)->with('success', 'Successfully reopened the job');
        } else {
            return redirect()->route('job', $job)->with('success', 'Successfully reopened the job');
        }
    }

    /**
     * Show the closed jobs.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function closedJobs()
    {
        $jobs = MaintenanceJob::closed()->orderByDesc('created_at')->paginate();

        $closed = true;

        return view('auth.management.maintenance.index', compact('jobs', 'closed'));
    }

    /**
     * Process the request to delete a maintenance job.
     *
     * @param $maintenance_job_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($maintenance_job_id)
    {
        $maintenanceJob = MaintenanceJob::findOrFail($maintenance_job_id);

        return view('auth.management.maintenance.delete', compact('maintenanceJob'));
    }

    /**
     * Process the request to delete a maintenance job.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete(Request $request)
    {
        $this->validate($request, [
            'maintenance_job_id'    => 'required'
        ]);

        $maintenanceJob = MaintenanceJob::findOrFail($request->input('maintenance_job_id'));

        $maintenanceJob->delete();

        return redirect()->route('jobs')->with('success', 'Successfully deleted maintenance job');
    }
}
