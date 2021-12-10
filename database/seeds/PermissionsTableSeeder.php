<?php

use App\Models\Authorization\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'cms_access',
            ],
            [
                'id'    => '18',
                'title' => 'product_category_create',
            ],
            [
                'id'    => '19',
                'title' => 'product_category_edit',
            ],
            [
                'id'    => '20',
                'title' => 'product_category_show',
            ],
            [
                'id'    => '21',
                'title' => 'product_category_delete',
            ],
            [
                'id'    => '22',
                'title' => 'product_category_access',
            ],
            [
                'id'    => '23',
                'title' => 'slider_access',
            ],
            [
                'id'    => '24',
                'title' => 'slider_create',
            ],
            [
                'id'    => '25',
                'title' => 'slider_edit',
            ],
            [
                'id'    => '26',
                'title' => 'slider_show',
            ],
            [
                'id'    => '27',
                'title' => 'slider_delete',
            ],
            [
                'id'    => '28',
                'title' => 'popup_access',
            ],
            [
                'id'    => '29',
                'title' => 'popup_create',
            ],
            [
                'id'    => '30',
                'title' => 'popup_edit',
            ],
            [
                'id'    => '31',
                'title' => 'popup_show',
            ],
            [
                'id'    => '32',
                'title' => 'popup_delete',
            ],
            [
                'id'    => '33',
                'title' => 'setting_create',
            ],
            [
                'id'    => '34',
                'title' => 'product_management_access',
            ],            
            [
                'id'    => '35',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);

    }
}
