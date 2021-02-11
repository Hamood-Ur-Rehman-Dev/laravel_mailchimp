<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'              => 'Admin',
                'email'             => 'admin@example.com',
                'email_verified_at'	=> now(),
                'password'          => bcrypt('password'),
            ]
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
