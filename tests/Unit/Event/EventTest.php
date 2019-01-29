<?php

namespace Tests\Unit\Event;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function we_dont_include_events_that_are_not_for_today_in_the_count()
    {
        Event::create([
            'title'             => 'Test Event',
            'description'       => 'This is a test event',
            'start_datetime'    => Carbon::now()->subDay(1)->toDateString()
        ]);

        $this->assertTrue(
            Event::today()->count() === 0
        );
    }

    /** @test */
    public function we_count_today_events_properly()
    {
        Event::create([
            'title'             => 'Test Event',
            'description'       => 'This is a test event',
            'start_datetime'    => Carbon::now()->toDateString()
        ]);

        $this->assertTrue(
            Event::today()->count() === 1
        );
    }

    /** @test */
    public function we_scope_the_number_of_events_to_a_resident_properly()
    {
        $eventToday = Event::create([
            'title'             => 'Test Event',
            'description'       => 'This is a test event',
            'start_datetime'    => Carbon::now()->toDateString()
        ]);

        $user = User::create([
            'first_name'    => 'Resident',
            'last_name'     => 'User',
            'username'      => 'resident123',
            'password'      => bcrypt('resident123'),
            'type'          => 'resident'
        ]);

        // get the user's interested events
        $userEventsToday = $user->interestedEvents()->today()->get();

        // user should have zero interested events
        $this->assertTrue($userEventsToday->count() === 0);

        // register interest in the event, this event is for today
        $user->registerInterest($eventToday);

        // get the user's events again, there should be one registered
        $userEventsToday = $user->interestedEvents()->today()->get();

        // now, the user should be interested in one event (TODAY)
        $this->assertTrue($userEventsToday->count() === 1);

        // we need to also check that events later than today don't get pulled back in to the count
        $eventNextWeek = Event::create([
            'title'             => 'Test Event',
            'description'       => 'This is a test event',
            'start_datetime'    => Carbon::now()->addDays(7)->toDateString()
        ]);

        // get the events again
        $userEventsToday = $user->interestedEvents()->today()->get();

        // user still should have 1 event that they are interested in for today
        $this->assertTrue($userEventsToday->count() === 1);

        // register the user in the next week event
        $user->registerInterest($eventNextWeek);

        // get the events again
        $userEventsToday = $user->interestedEvents()->today()->get();

        // user still should have 1 event that they are interested in for today
        $this->assertTrue($userEventsToday->count() === 1);

        // .. but in total, should be interested in two events
        // get the events again
        $userEventsTotal = $user->interestedEvents()->get();
        $this->assertTrue($userEventsTotal->count() === 2);
    }
}
