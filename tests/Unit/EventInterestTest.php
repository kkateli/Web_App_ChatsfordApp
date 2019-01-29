<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventInterestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function we_can_register_interest_with_an_event()
    {
        $user = User::create([
            'first_name'    => 'Resident',
            'last_name'     => 'User',
            'username'      => 'resident123',
            'password'      => bcrypt('resident123'),
            'type'          => 'resident'
        ]);

        $event = Event::create([
            'title'             => 'this is a test',
            'description'       => 'Testing mc testterson',
            'start_datetime'    => now()
        ]);

        $user
            ->registerInterest($event);

        $this->assertTrue(
            $user->interestedEvents()->get()->contains('id', $event->id)
        );
    }

    /** @test */
    public function we_can_see_if_a_user_has_upcoming_events()
    {
        $user = User::create([
            'first_name'    => 'Resident',
            'last_name'     => 'User',
            'username'      => 'resident123',
            'password'      => bcrypt('resident123'),
            'type'          => 'resident'
        ]);

        $event = Event::create([
            'title'             => 'this is a test',
            'description'       => 'Testing mc testterson',
            'start_datetime'    => now()->addDay(10)
        ]);

        // this should be false, we haven't registered interest for any event
        $this->assertFalse(
            $user->hasUpcomingEvents()
        );

        $user->registerInterest($event);

        $this->assertTrue(
            $user->hasUpcomingEvents()
        );
    }

    /** @test */
    public function a_user_cant_register_interest_in_an_event_twice()
    {
        $user = User::create([
            'first_name'    => 'Resident',
            'last_name'     => 'User',
            'username'      => 'resident123',
            'password'      => bcrypt('resident123'),
            'type'          => 'resident'
        ]);

        $event = Event::create([
            'title'             => 'this is a test',
            'description'       => 'Testing mc testterson',
            'start_datetime'    => now()->addDay(10)
        ]);

        // this should be false, we haven't registered interest for any event
        $this->assertFalse(
            $user->hasUpcomingEvents()
        );

        $this->assertFalse(
            $user->hasRegisteredInterestFor($event)
        );

        $user->registerInterest($event);

        $this->assertTrue(
            $user->hasRegisteredInterestFor($event)
        );
    }
}
