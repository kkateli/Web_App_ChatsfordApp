<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the resident's dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        // get the logged in user
        $user = auth()->user();


        // show the user's announcements
        $announcements   = $user->getAnnouncements();

        // show the dashboard and pass in the user
        return view('auth.residents.dashboard', compact('user', 'announcements'));
    }

}
