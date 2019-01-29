<?php

namespace App\Http\Controllers\Management;

use App\Models\Complaint;
use App\Models\Event;
use App\Models\Home;
use App\Models\MaintenanceJob;
use App\Models\User;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the dashboard page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        // get the logged in user
        $user           = auth()->user();

        // get the overview statistics
        $homecount      = Home::count();
        $residentcount  = User::active()->residents()->count();
        $employeecount  = User::active()->employees()->count();
        $eventcount     = Event::today()->count();
        $requestcount   = MaintenanceJob::open()->count();
        $complaints     = Complaint::open()->count();

        // show the dashboard and pass in the user
        return view('auth.management.dashboard', compact('user', 'homecount', 'residentcount', 'employeecount', 'eventcount','requestcount', 'complaints'));
    }
}
