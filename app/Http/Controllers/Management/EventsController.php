<?php

namespace App\Http\Controllers\Management;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{
    /**
     * Show the list of the events, sorted by their upcoming date.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Event::orderByDesc('start_datetime')
                        ->withCount('interestedUsers')
                        ->paginate();

        return view('auth.management.events.index', compact('events'));
    }

    /**
     * Show the view to add an event.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('auth.management.events.add');
    }

    /**
     * Process the request to add an event.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(Request $request)
    {
        // validation messages to show
        $messages = [
            'title.required'                      => 'Please enter a title',
            'description.required'                => 'Please enter a description',
            'date_submit.required'                => 'Please select a date',
            'time_submit.required'                => 'Please select a time',
            'cost.numeric'                        => 'Please enter a numeric value',
            'end_date_submit.required_with'       => 'Please select a date',
            'end_time_submit.required_with'       => 'Please select a time'
        ];

        // validate the request
        $this->validate($request, [
            'title'             => 'required',
            'description'       => 'required',
            'location'          => 'nullable',
            'date_submit'       => 'required|date_format:Y-m-d',
            'time_submit'       => 'required|date_format:H:i',
            'end_date_submit'   => 'nullable|required_with:end_time_submit|date_format:Y-m-d',
            'end_time_submit'   => 'nullable|required_with:end_date_submit|date_format:H:i',
            'cost'              => 'nullable|numeric'
        ], $messages);

        // we have to join the date and time fields together
        $start_datetime = Carbon::parse(
            $request->input('date_submit') . $request->input('time_submit')
        );

        if ($request->filled('end_date_submit') && $request->filled('end_time_submit')) {
            $end_datetime = Carbon::parse(
                $request->input('end_date_submit') . $request->input('end_time_submit')
            );
        } else {
            $end_datetime = null;
        }

        // create the event
        Event::create([
            'title'             => $request->input('title'),
            'description'       => $request->input('description'),
            'start_datetime'    => $start_datetime,
            'end_datetime'      => $end_datetime,
            'location'          => $request->input('location'),
            'cost'              => $request->input('cost')
        ]);

        // redirect to the events view
        return redirect()->route('events')->with('success', 'Successfully added event');
    }

    /**
     * View an event.
     *
     * @param $event_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($event_id)
    {
        $event = Event::findOrFail($event_id);

        $interestedUsers = $event->interestedUsers()->paginate();

        return view('auth.management.events.view', compact('event', 'interestedUsers'));
    }

    /**
     * View an event.
     *
     * @param $event_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($event_id)
    {
        $event = Event::findOrFail($event_id);

        return view('auth.management.events.edit', compact('event'));
    }

    /**
     * Process the request to edit an event.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        // validation messages to show
        $messages = [
            'title.required'        => 'Please enter a title',
            'description.required'  => 'Please enter a description',
            'date_submit.required'  => 'Please select a date',
            'time_submit.required'  => 'Please select a time',
            'cost.numeric'          => 'Please enter a numeric value',
            'end_date_submit.required_with'       => 'Please select a date',
            'end_time_submit.required_with'       => 'Please select a time'
        ];

        // validate the request
        $validated = $this->validate($request, [
            'event_id'          => 'required',
            'title'             => 'required',
            'description'       => 'required',
            'location'          => 'nullable',
            'date_submit'       => 'required|date_format:Y-m-d',
            'time_submit'       => 'required|date_format:H:i',
            'end_date_submit'   => 'nullable|required_with:end_time_submit|date_format:Y-m-d',
            'end_time_submit'   => 'nullable|required_with:end_date_submit|date_format:H:i',
            'cost'              => 'nullable|numeric'
        ], $messages);

        $event = Event::findOrFail($request->input('event_id'));

        // we have to join the date and time fields together
        $start_datetime = Carbon::parse(
            $request->input('date_submit') . $request->input('time_submit')
        );

        if ($request->filled('end_date_submit') && $request->filled('end_time_submit')) {
            $end_datetime = Carbon::parse(
                $request->input('end_date_submit') . $request->input('end_time_submit')
            );
        } else {
            $end_datetime = null;
        }

        $event->update(array_merge(
            [
                'start_datetime'    => $start_datetime,
                'end_datetime'      => $end_datetime
            ],
            $validated
        ));

        return redirect()->route('events')->with('success', 'Successfully edited event');
    }

    /**
     * Show the form to register interest for a resident.
     *
     * @param $event_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registerInterestForResident($event_id)
    {
        $event = Event::findOrFail($event_id);

        return view('auth.management.events.register-interest', compact('event'));
    }

    /**
     * Process the request to register interest for an event.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegisterInterestForResident(Request $request)
    {
        $messages = [
            'resident_id.required'  => 'Please select a resident'
        ];

        $this->validate($request, [
            'resident_id'   => 'required',
            'event_id'      => 'required'
        ], $messages);

        // get the resident
        $user = User::residents()->findOrFail($request->input('resident_id'));

        // get the event to register for
        $event = Event::findOrFail($request->input('event_id'));

        // determine if the user has registered
        if ($user->hasRegisteredInterestFor($event)) {
            return redirect()->route('event', $event)->with('error', 'This user has already registered their interest for this event');
        }

        $user->registerInterest($event);

        return redirect()->route('event', $event)->with('success', 'Successfully registered interest for resident');
    }

    /**
     * Process the request to cancel a resident's interest.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCancelInterestForResident(Request $request)
    {
        $messages = [
            'resident_id.required'  => 'Please select a resident'
        ];

        $this->validate($request, [
            'resident_id'   => 'required',
            'event_id'      => 'required'
        ], $messages);

        $user = User::residents()->findOrFail($request->input('resident_id'));

        // get the event to register for
        $event = Event::findOrFail($request->input('event_id'));

        $user->deregisterInterest($event);

        return redirect()->route('event', $event)->with('success', 'Successfully removed resident\'s interest from this event');
    }

    /**
     * Show the delete confirmation view.
     *
     * @param $event_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($event_id)
    {
        $event = Event::withCount('interestedUsers')->findOrFail($event_id);

        return view('auth.management.events.delete', compact('event'));
    }

    /**
     * Process the request to delete an event.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete(Request $request)
    {
        $this->validate($request, [
            'event_id'  => 'required'
        ]);

        $event = Event::findOrFail($request->input('event_id'));

        $event->delete();

        return redirect()->route('events')->with('success', 'Successfully deleted event');
    }
}
