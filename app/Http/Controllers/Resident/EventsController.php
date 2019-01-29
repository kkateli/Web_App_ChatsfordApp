<?php

namespace App\Http\Controllers\Resident;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{
    /**
     * Show the list of interested events.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();

        $userUpcomingEvents = $user->interestedEvents()->current()->orderBy('start_datetime')->get();

        return view('auth.residents.events.index', compact('events', 'userUpcomingEvents'));
    }

    /**
     * Show the upcoming events.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function upcoming()
    {
        $events = Event::orderBy('start_datetime')->current()->paginate();

        return view('auth.residents.events.upcoming', compact('events'));
    }

    /**
     * Show the past events.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function past()
    {
        $events = Event::orderBy('start_datetime')->past()->paginate();

        return view('auth.residents.events.past', compact('events'));
    }

    /**
     * Process the request to register interest in an event.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerInterest(Request $request)
    {
        $this->validate($request, [
            'event_id'  => 'required'
        ]);

        // get the user
        $user = auth()->user();

        // get the event to register for
        $event = Event::findOrFail($request->input('event_id'));

        // determine if the user has registered
        if ($user->hasRegisteredInterestFor($event)) {
            return redirect()->route('resident.events')->with('error', 'You have already registered interest for this event');
        }

        // otherwise, register the resident's interest
        $user->registerInterest($event);

        return redirect()->route('resident.events')->with('success', 'Successfully registered interest in event');
    }

    /**
     * Process the request to remove the user's interest from this event.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deregisterInterest(Request $request)
    {
        $this->validate($request, [
            'event_id'  => 'required'
        ]);

        $user = auth()->user();

        // get the event to register for
        $event = Event::findOrFail($request->input('event_id'));

        $user->deregisterInterest($event);

        return redirect()->route('resident.events')->with('success', 'Successfully removed interest from this event');
    }
}
