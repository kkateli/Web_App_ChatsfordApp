<?php

namespace App\Http\Controllers\Common;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    /**
     * Process request to add a comment to an announcement.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(Request $request)
    {
        $messages = [
            'comment.required'  => 'Please enter your comment'
        ];

        $this->validate($request, [
            'comment'           => 'required',
            'announcement_id'   => 'required'
        ], $messages);

        $announcement = Announcement::findOrFail($request->input('announcement_id'));

        $announcement->comments()->create([
            'user_id'   => auth()->id(),
            'comment'   => $request->input('comment')
        ]);

        if (auth()->user()->isManagement()) {
            return redirect()->route('announcements.view', $announcement)->with('success', 'Successfully added comment');
        }

        return redirect()->route('residents.announcements.view', $announcement)->with('success', 'Successfully added comment');
    }
}
