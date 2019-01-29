<?php

use Illuminate\Database\Seeder;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'first_name'    => 'Admin',
            'last_name'     => 'User',
            'username'      => 'admin',
            'password'      => bcrypt('admin'),
            'type'          => 'management'
        ]);

        \App\Models\User::create([
            'first_name'    => 'Maintenance',
            'last_name'     => 'User',
            'username'      => 'maintenance',
            'password'      => bcrypt('maintenance'),
            'type'          => 'maintenance'
        ]);


        \App\Models\User::create([
            'first_name'    => 'Resident',
            'last_name'     => 'User',
            'username'      => 'resident1',
            'password'      => bcrypt('resident'),
            'type'          => 'resident'
        ]);
    }
}
