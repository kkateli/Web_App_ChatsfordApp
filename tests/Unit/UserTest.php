<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function we_identify_resident_users()
    {
        $user = User::create([
            'first_name'    => 'Resident',
            'last_name'     => 'User',
            'username'      => 'resident123',
            'password'      => bcrypt('resident123'),
            'type'          => 'resident'
        ]);

        $this->assertTrue($user->isResident());
        $this->assertFalse($user->isManagement());
        $this->assertFalse($user->isMaintenance());
    }

    /** @test */
    public function we_identify_management_users()
    {
        $user = User::create([
            'first_name'    => 'Management',
            'last_name'     => 'User',
            'username'      => 'management123',
            'password'      => bcrypt('management123'),
            'type'          => 'management'
        ]);

        $this->assertFalse($user->isResident());
        $this->assertTrue($user->isManagement());
        $this->assertFalse($user->isMaintenance());
    }

    /** @test */
    public function we_identify_maintenance_users()
    {
        $user = User::create([
            'first_name'    => 'Maintenance',
            'last_name'     => 'User',
            'username'      => 'Maintenance',
            'password'      => bcrypt('maintenance'),
            'type'          => 'maintenance'
        ]);

        $this->assertFalse($user->isResident());
        $this->assertFalse($user->isManagement());
        $this->assertTrue($user->isMaintenance());
    }

    /** @test */
    public function we_identify_active_users()
    {
        $user = User::create([
            'first_name'    => 'Maintenance',
            'last_name'     => 'User',
            'username'      => 'Maintenance',
            'password'      => bcrypt('maintenance'),
            'type'          => 'maintenance',
            'status'        => 1
        ]);

        $this->assertTrue($user->isActive());
        $this->assertFalse($user->isInactive());
    }


    /** @test */
    public function we_identify_inactive_users()
    {
        $user = User::create([
            'first_name'    => 'Maintenance',
            'last_name'     => 'User',
            'username'      => 'Maintenance',
            'password'      => bcrypt('maintenance'),
            'type'          => 'maintenance',
            'status'        => 0
        ]);

        $this->assertTrue($user->isInactive());
        $this->assertFalse($user->isActive());
    }
}
