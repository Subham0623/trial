<?php

use App\Models\Authorization\User\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('users')->delete();

        $users = [
            [
                'id'             => 1,
                'name'           => 'IT Admin',
                'email'          => 'itadmin@admin.com',
                'password'       => '$2y$10$i26rCvp3b/tuNErkkxvVKOtz9kHprc9XVEswdAOLxBnQvOkeOpcYe', //password
                'remember_token' => null,
                'email_verified_at' => Carbon::now(),
            ],
            [
                'id'             => 2,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$i26rCvp3b/tuNErkkxvVKOtz9kHprc9XVEswdAOLxBnQvOkeOpcYe',
                'remember_token' => null,
                'email_verified_at' => Carbon::now(),
            ],
            [
                'id'             => 3,
                'name'           => 'User',
                'email'          => 'user@user.com',
                'password'       => '$2y$10$i26rCvp3b/tuNErkkxvVKOtz9kHprc9XVEswdAOLxBnQvOkeOpcYe',
                'remember_token' => null,
                'email_verified_at' => Carbon::now(),
            ],
        ];

        User::insert($users);

    }
}
