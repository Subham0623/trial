<?php

use App\Models\Authorization\Role;
use App\Models\Authorization\User\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        //disable foreign key check for this connection before running seeders
		\DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \DB::table('roles')->truncate(); 

        //disable foreign key check for this connection before running seeders
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user = User::findOrFail(1);
        $roles = [
            [
                'id'    => 1,
                'title' => 'IT Admin',
                'created_by'    => $user->id,
            ],
            [
                'id'    => 2,
                'title' => 'System Admin',
                'created_by'    => $user->id,
            ],
            [
                'id'    => 3,
                'title' => 'User',
                'created_by'    => $user->id,
            ],
        ];

        Role::insert($roles);

    }
}
