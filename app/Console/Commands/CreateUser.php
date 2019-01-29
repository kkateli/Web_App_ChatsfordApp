<?php

namespace App\Console\Commands;

use App\Models\User;
use Hash;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = new User;

        $fillables = $user->getFillable();
        $fillables = array_diff($fillables, [
            'gender', 'date_of_birth', 'home_id'
        ]);

        foreach($fillables as $key => $fillable) {
            if ($fillable == 'password') {
                $user->password = bcrypt($this->secret(($key + 1) . "/" . count($fillables) . " User $fillable"));
            } else {
                $user->$fillable = $this->ask(($key+1) . "/" . count($fillables) . " User $fillable");
            }
        }

        if ($this->confirm("Do you want to create the user?", true)) {
            $user->save();
            $this->info("User created (id: {$user->id})");
        }
        return true;
    }
}
