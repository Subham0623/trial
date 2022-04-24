<?php

use App\Models\Authorization\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('permissions')->delete();
        
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
            [
                'id'    => '36',
                'title' => 'subject_area_create',
            ],
            [
                'id'    => '37',
                'title' => 'subject_area_edit',
            ],
            [
                'id'    => '38',
                'title' => 'subject_area_show',
            ],
            [
                'id'    => '39',
                'title' => 'subject_area_delete',
            ],
            [
                'id'    => '40',
                'title' => 'subject_area_access',
            ],
            [
                'id'    => '41',
                'title' => 'parameter_create',
            ],
            [
                'id'    => '42',
                'title' => 'parameter_edit',
            ],
            [
                'id'    => '43',
                'title' => 'parameter_show',
            ],
            [
                'id'    => '44',
                'title' => 'parameter_delete',
            ],
            [
                'id'    => '45',
                'title' => 'parameter_access',
            ],
            [
                'id'    => '46',
                'title' => 'province_create',
            ],
            [
                'id'    => '47',
                'title' => 'province_edit',
            ],
            [
                'id'    => '48',
                'title' => 'province_show',
            ],
            [
                'id'    => '49',
                'title' => 'province_delete',
            ],
            [
                'id'    => '50',
                'title' => 'province_access',
            ],
            [
                'id'    => '51',
                'title' => 'organization_create',
            ],
            [
                'id'    => '52',
                'title' => 'organization_edit',
            ],
            [
                'id'    => '53',
                'title' => 'organization_show',
            ],
            [
                'id'    => '54',
                'title' => 'organization_delete',
            ],
            [
                'id'    => '55',
                'title' => 'organization_access',
            ],
            [
                'id'    => '56',
                'title' => 'document_create',
            ],
            [
                'id'    => '57',
                'title' => 'document_edit',
            ],
            [
                'id'    => '58',
                'title' => 'document_show',
            ],
            [
                'id'    => '59',
                'title' => 'document_delete',
            ],
            [
                'id'    => '60',
                'title' => 'document_access',
            ],
            [
                'id'    => '61',
                'title' => 'group_create',
            ],
            [
                'id'    => '62',
                'title' => 'group_edit',
            ],
            [
                'id'    => '63',
                'title' => 'group_show',
            ],
            [
                'id'    => '64',
                'title' => 'group_delete',
            ],
            [
                'id'    => '65',
                'title' => 'group_access',
            ],
            [
                'id'    => '66',
                'title' => 'form_create',
            ],
            [
                'id'    => '67',
                'title' => 'form_edit',
            ],
            [
                'id'    => '68',
                'title' => 'form_access',
            ],
            [
                'id'    => '69',
                'title' => 'form_publish',
            ],
        ];

        Permission::insert($permissions);

    }
}
