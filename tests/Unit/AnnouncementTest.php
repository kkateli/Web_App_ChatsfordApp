<?php

namespace Tests\Unit;

use App\Models\Announcement;
use App\Models\Area;
use App\Models\Home;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnnouncementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function we_test_an_annoucement_to_an_area()
    {
        $user = User::create([
            'first_name'    => 'Resident',
            'last_name'     => 'User',
            'username'      => 'resident123',
            'password'      => bcrypt('resident123'),
            'type'          => 'resident'
        ]);

        $area = Area::create([
            'name'  => 'Area Test'
        ]);

        $home = Home::create([
            'number'    => '123',
            'name'      => 'Area Test',
            'area_id'   => $area->id
        ]);

        $user->update([
            'home_id'   => $home->id
        ]);

        $announcement = Announcement::create([
            'title'     => 'test announcement',
            'body'      => 'testing body',
            'user_id'   => $user->id,
            'status'    => 1
        ]);

        $announcement->addAreas([
            $area->id
        ]);
        
        // get the announcements
        $announcements = $user->getAnnouncements();

        $this->assertTrue($announcements->count() === 1);
    }
}
