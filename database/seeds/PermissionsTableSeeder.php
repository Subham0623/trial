<?php

use App\Permission;
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
                'title' => 'product_management_access',
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
                'title' => 'product_tag_create',
            ],
            [
                'id'    => '24',
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => '25',
                'title' => 'product_tag_show',
            ],
            [
                'id'    => '26',
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => '27',
                'title' => 'product_tag_access',
            ],
            [
                'id'    => '28',
                'title' => 'product_create',
            ],
            [
                'id'    => '29',
                'title' => 'product_edit',
            ],
            [
                'id'    => '30',
                'title' => 'product_show',
            ],
            [
                'id'    => '31',
                'title' => 'product_delete',
            ],
            [
                'id'    => '32',
                'title' => 'product_access',
            ],
            [
                'id'    => '33',
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => '34',
                'title' => 'book_create',
            ],
            [
                'id'    => '35',
                'title' => 'book_edit',
            ],
            [
                'id'    => '36',
                'title' => 'book_show',
            ],
            [
                'id'    => '37',
                'title' => 'book_delete',
            ],
            [
                'id'    => '38',
                'title' => 'book_access',
            ],
            [
                'id'    => '39',
                'title' => 'author_create',
            ],
            [
                'id'    => '40',
                'title' => 'author_edit',
            ],
            [
                'id'    => '41',
                'title' => 'author_show',
            ],
            [
                'id'    => '42',
                'title' => 'author_delete',
            ],
            [
                'id'    => '43',
                'title' => 'author_access',
            ],
            [
                'id'    => '44',
                'title' => 'level_access',
            ],
            [
                'id'    => '45',
                'title' => 'level_show',
            ],
            [
                'id'    => '46',
                'title' => 'level_edit',
            ],
            [
                'id'    => '47',
                'title' => 'level_delete',
            ],
            [
                'id'    => '48',
                'title' => 'level_create',
            ],
            [
                'id'    => '49',
                'title' => 'review_access',
            ],
            [
                'id'    => '50',
                'title' => 'review_show',
            ],
            [
                'id'    => '51',
                'title' => 'review_delete',
            ],
            [
                'id'    => '52',
                'title' => 'slider_access',
            ],
            [
                'id'    => '53',
                'title' => 'slider_create',
            ],
            [
                'id'    => '54',
                'title' => 'slider_edit',
            ],
            [
                'id'    => '55',
                'title' => 'slider_show',
            ],
            [
                'id'    => '56',
                'title' => 'slider_delete',
            ],
            [
                'id'    => '57',
                'title' => 'popup_access',
            ],
            [
                'id'    => '58',
                'title' => 'popup_create',
            ],
            [
                'id'    => '59',
                'title' => 'popup_edit',
            ],
            [
                'id'    => '60',
                'title' => 'popup_show',
            ],
            [
                'id'    => '61',
                'title' => 'popup_delete',
            ],
            [
                'id'    => '62',
                'title' => 'setting_create',
            ],
        ];

        Permission::insert($permissions);

    }
}
