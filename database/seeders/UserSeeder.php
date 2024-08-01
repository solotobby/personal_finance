<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Oluwatobi Admin', 'email' => 'solo@ad.com', 'password' => bcrypt('solomon001'), 'role' => 'admin'],
            ['name' => 'Oluwatobi Solomon', 'email' => 'solando@pf.com', 'password' => bcrypt('solomon001'), 'role' => 'user'],
            ['name' => 'Samuel Tobi', 'email' => 'tobi@pf.com', 'password' => bcrypt('solomon001'), 'role' => 'user']
        ];

        foreach($users as $user){
            User::firstOrCreate($user);
        }
    }
}
