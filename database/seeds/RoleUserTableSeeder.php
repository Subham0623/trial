<?php

use App\Models\Authorization\User\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('role_user')->delete();
        
        User::findOrFail(1)->roles()->sync(1);
        User::findOrFail(2)->roles()->sync(2);

    }
}
