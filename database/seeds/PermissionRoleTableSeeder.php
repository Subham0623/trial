<?php

use App\Models\Authorization\Permission;
use App\Models\Authorization\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('permission_role')->delete();

        $permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($permissions->pluck('id')); //all possible permissions grant to IT Admin

        $system_admin_permissions = $permissions->filter(function ($permission) {
            return substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 6) != 'group_';
        });
        Role::findOrFail(2)->permissions()->sync($system_admin_permissions); //selected permissions grant to system admin

        $user_permissions = $permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        });
        Role::findOrFail(3)->permissions()->sync($user_permissions); //selected permissions grant to normal user

    }
}
