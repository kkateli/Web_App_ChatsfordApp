<?php

namespace Tests\Unit;

use App\Models\Area;
use App\Models\Home;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_home_can_be_assigned_to_an_area()
    {
        $home = Home::create([
            'number' => 123,
            'name'   => 'Test Home'
        ]);

        $area = Area::create([
            'name'  => 'Area 91'
        ]);

        $home->assignArea($area);

        $this->assertTrue(
            $home->area()->get()->contains('name', 'Area 91')
        );
    }
}
