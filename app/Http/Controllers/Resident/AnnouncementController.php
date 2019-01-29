<?php

namespace App\Http\Controllers\Resident;

use App\Models\Announcement;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    /**
     * Show the announcement.
     *
     * @param $announcement_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($announcement_id)
    {
        $announcement = Announcement::with('comments.user')->findOrFail($announcement_id);

        return view('auth.residents.announcements.view', compact('announcement'));
    }
}
