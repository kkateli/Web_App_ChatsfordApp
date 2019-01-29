<?php

namespace App\Http\Controllers\Management;

use App\Models\Announcement;
use App\Models\Area;
use App\Models\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    /**
     * Show all of the announcements.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $announcements = Announcement::with('areas', 'homes')->withCount('comments')->orderByDesc('created_at')->paginate();

        return view('auth.management.announcements.index', compact('announcements'));
    }

    /**
     * Show a specific announcement.
     *
     * @param $announcement_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($announcement_id)
    {
        $announcement = Announcement::findOrFail($announcement_id);

        $comments     = $announcement->comments()->with('user')->get();

        return view('auth.management.announcements.view', compact('announcement', 'comments'));
    }

    /**
     * Show the add announcement view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $homes = Home::orderBy('name')->get();
        $areas = Area::orderBy('name')->get();

        return view('auth.management.announcements.add', compact('homes', 'areas'));
    }

    /**
     * Process the request to add an announcement.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(Request $request)
    {
        $messages = [
            'title.required'    => 'Please enter a title',
            'body.required'     => 'Please enter a description'
        ];

        $announcement = $this->validate($request, [
            'title'     => 'required',
            'body'      => 'required',
            'areas.*'   => 'nullable',
            'homes.*'   => 'nullable'
        ], $messages);

        // the user that is posting the announcement
        $user = auth()->id();

        DB::transaction(function() use ($announcement, $user, $request) {
            $announcement = Announcement::create(array_merge($announcement, [
                'user_id'   => $user,
                'status'    => 1
            ]));

            if ($request->filled('areas')) {
                $announcement->addAreas($request->input('areas'));
            }

            if ($request->filled('homes')) {
                $announcement->addHomes($request->input('homes'));
            }
        });

        return redirect()->route('announcements')->with('success', 'Successfully posted announcement');
    }

    /**
     * Hide the incoming announcement.
     *
     * @param $announcement_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hide($announcement_id)
    {
        $announcement = Announcement::findOrFail($announcement_id);

        $announcement->hide();

        return redirect()->route('announcements.view', $announcement)->with('success', 'Successfully hidden announcement');
    }

    /**
     * Reopen the incoming announcement.
     *
     * @param $announcement_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reopen($announcement_id)
    {
        $announcement = Announcement::findOrFail($announcement_id);

        $announcement->show();

        return redirect()->route('announcements.view', $announcement)->with('success', 'Successfully reposted announcement');
    }

    /**
     * Show the delete confirmation screen.
     *
     * @param $announcement_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($announcement_id)
    {
        $announcement = Announcement::withCount('comments')->findOrFail($announcement_id);

        return view('auth.management.announcements.delete', compact('announcement'));
    }

    /**
     * Process the request to delete the announcement.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete(Request $request)
    {
        $this->validate($request, [
            'announcement_id'   => 'required'
        ]);

        $announcement = Announcement::findOrFail($request->input('announcement_id'));

        $announcement->delete();

        return redirect()->route('announcements')->with('success', 'Successfully removed announcement');
    }
}
