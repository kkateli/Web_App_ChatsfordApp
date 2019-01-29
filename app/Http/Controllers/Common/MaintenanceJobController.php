<?php

namespace App\Http\Controllers\Common;

use App\Models\MaintenanceJob;
use App\Http\Controllers\Controller;

class MaintenanceJobController extends Controller
{
    /**
     * Show the closed jobs for all types of users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function closedJobs()
    {
        $user = auth()->user();

        if ($user->isResident()) {
            // get resident's closed jobs
            $jobs = $user->maintenance_jobs()->closed()->paginate();

            $closed = true;

            return view('auth.residents.maintenance.index', compact('jobs', 'closed'));
        }

        $jobs = MaintenanceJob::closed()->paginate();

        $closed = true;

        return view('auth.management.maintenance.index', compact('jobs', 'closed'));
    }
}
