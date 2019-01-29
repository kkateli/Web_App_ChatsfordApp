<?php

namespace App\Http\Controllers\Maintenance;

use App\Models\MaintenanceType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the maintenance dashboard controller.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        $maintenanceTypes = MaintenanceType::withCount(['maintenance_jobs' => function($query) {
            return $query->open();
        }])->get();

        return view('auth.maintenance.dashboard', compact('maintenanceTypes'));
    }
}
