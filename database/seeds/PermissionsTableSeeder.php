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
                'display_name' => 'Access User Management',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
                'display_name' => 'Create Permission'
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
                'display_name' => 'Edit Permission'
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
                'display_name' => 'Show Permission'
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
                'display_name' => 'Delete Permission'
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
                'display_name' => 'Access Permission'
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
                'display_name' =>'Role Create'
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
                'display_name' =>'Role Edit'
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
                'display_name' =>'Role Show'
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
                'display_name' =>'Role Delete'
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
                'display_name' =>'Role Access'
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
                'display_name' =>'User Create'
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
                'display_name' => 'User Edit'
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
                'display_name' => 'Show User'
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
                'display_name' => 'Delete User'
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
                'display_name' => 'Access User'
            ],
            [
                'id'    => '17',
                'title' => 'cms_access',
                'display_name' => 'Access CMS'
            ],
            [
                'id'    => '18',
                'title' => 'product_category_create',
                'display_name' => 'Create Product Category'
            ],
            [
                'id'    => '19',
                'title' => 'product_category_edit',
                'display_name' => 'Edit Product Category'
            ],
            [
                'id'    => '20',
                'title' => 'product_category_show',
                'display_name' => 'Show Product Category'
            ],
            [
                'id'    => '21',
                'title' => 'product_category_delete',
                'display_name' => 'Delete Product Category'
            ],
            [
                'id'    => '22',
                'title' => 'product_category_access',
                'display_name' => 'Access Product Category'
            ],
            [
                'id'    => '23',
                'title' => 'slider_access',
                'display_name' => 'Access Slider'
            ],
            [
                'id'    => '24',
                'title' => 'slider_create',
                'display_name' => 'Create Slider'
            ],
            [
                'id'    => '25',
                'title' => 'slider_edit',
                'display_name' => 'Edit Slider'
            ],
            [
                'id'    => '26',
                'title' => 'slider_show',
                'display_name' => 'Show Slider'
            ],
            [
                'id'    => '27',
                'title' => 'slider_delete',
                'display_name' => 'Delete Slider'
            ],
            [
                'id'    => '28',
                'title' => 'popup_access',
                'display_name' => 'Access Popup'
            ],
            [
                'id'    => '29',
                'title' => 'popup_create',
                'display_name' => 'Create Popup'
            ],
            [
                'id'    => '30',
                'title' => 'popup_edit',
                'display_name' => 'Edit Popup'
            ],
            [
                'id'    => '31',
                'title' => 'popup_show',
                'display_name' => 'Show Popup'
            ],
            [
                'id'    => '32',
                'title' => 'popup_delete',
                'display_name' => 'Delete Popup'
            ],
            [
                'id'    => '33',
                'title' => 'setting_create',
                'display_name' => 'Create Setting'
            ],
            [
                'id'    => '34',
                'title' => 'product_management_access',
                'display_name' => 'Access Product Management'
            ],            
            [
                'id'    => '35',
                'title' => 'profile_password_edit',
                'display_name' => 'Edit Profile Password'
            ],
            [
                'id'    => '36',
                'title' => 'subject_area_create',
                'display_name' => 'Create Subject Area'
            ],
            [
                'id'    => '37',
                'title' => 'subject_area_edit',
                'display_name' => 'Edit Subject Area'
            ],
            [
                'id'    => '38',
                'title' => 'subject_area_show',
                'display_name' => 'Show Subject Area'
            ],
            [
                'id'    => '39',
                'title' => 'subject_area_delete',
                'display_name' => 'Delete Subject Area'
            ],
            [
                'id'    => '40',
                'title' => 'subject_area_access',
                'display_name' => 'Access Subject Area'
            ],
            [
                'id'    => '41',
                'title' => 'parameter_create',
                'display_name' => 'Create Parameter'
            ],
            [
                'id'    => '42',
                'title' => 'parameter_edit',
                'display_name' => 'Edit Parameter'
            ],
            [
                'id'    => '43',
                'title' => 'parameter_show',
                'display_name' => 'Show Parameter'
            ],
            [
                'id'    => '44',
                'title' => 'parameter_delete',
                'display_name' => 'Delete Parameter'
            ],
            [
                'id'    => '45',
                'title' => 'parameter_access',
                'display_name' => 'Access Parameter'
            ],
            [
                'id'    => '46',
                'title' => 'province_create',
                'display_name' => 'Create Province'
            ],
            [
                'id'    => '47',
                'title' => 'province_edit',
                'display_name' => 'Edit Province'
            ],
            [
                'id'    => '48',
                'title' => 'province_show',
                'display_name' => 'Show Province'
            ],
            [
                'id'    => '49',
                'title' => 'province_delete',
                'display_name' => 'Delete Province'
            ],
            [
                'id'    => '50',
                'title' => 'province_access',
                'display_name' => 'Access Province'
            ],
            [
                'id'    => '51',
                'title' => 'organization_create',
                'display_name' => 'Create Organization'
            ],
            [
                'id'    => '52',
                'title' => 'organization_edit',
                'display_name' => 'Edit Organization'
            ],
            [
                'id'    => '53',
                'title' => 'organization_show',
                'display_name' => 'Show Organization'
            ],
            [
                'id'    => '54',
                'title' => 'organization_delete',
                'display_name' => 'Delete Organization'
            ],
            [
                'id'    => '55',
                'title' => 'organization_access',
                'display_name' => 'Access Organization'
            ],
            [
                'id'    => '56',
                'title' => 'document_create',
                'display_name' => 'Create Document'
            ],
            [
                'id'    => '57',
                'title' => 'document_edit',
                'display_name' => 'Edit Document'
            ],
            [
                'id'    => '58',
                'title' => 'document_show',
                'display_name' => 'Show Document'
            ],
            [
                'id'    => '59',
                'title' => 'document_delete',
                'display_name' => 'Delete Document'
            ],
            [
                'id'    => '60',
                'title' => 'document_access',
                'display_name' => 'Access Document'
            ],
            [
                'id'    => '61',
                'title' => 'group_create',
                'display_name' => 'Create Group'
            ],
            [
                'id'    => '62',
                'title' => 'group_edit',
                'display_name' => 'Edit Group'
            ],
            [
                'id'    => '63',
                'title' => 'group_show',
                'display_name' => 'Show Group'
            ],
            [
                'id'    => '64',
                'title' => 'group_delete',
                'display_name' => 'Delete Group'
            ],
            [
                'id'    => '65',
                'title' => 'group_access',
                'display_name' => 'Access Group'
            ],
            [
                'id'    => '66',
                'title' => 'form_create',
                'display_name' => 'Create Form'
            ],
            [
                'id'    => '67',
                'title' => 'form_edit',
                'display_name' => 'Edit Form'
            ],
            [
                'id'    => '68',
                'title' => 'form_access',
                'display_name' => 'Access Form'
            ],
            [
                'id'    => '69',
                'title' => 'form_publish',
                'display_name' => 'Publish Form'
            ],
            [
                'id'    => '70',
                'title' => 'type_create',
                'display_name' => 'Create Type'
            ],
            [
                'id'    => '71',
                'title' => 'type_edit',
                'display_name' => 'Edit Type'
            ],
            [
                'id'    => '72',
                'title' => 'type_delete',
                'display_name' => 'Delete Type'
            ],
            [
                'id'    => '73',
                'title' => 'type_show',
                'display_name' => 'Show Type'
            ],
            [
                'id'    => '74',
                'title' => 'type_access',
                'display_name' => 'Access Type'
            ],
            [
                'id'    => '75',
                'title' => 'governance_create',
                'display_name' => 'Create Governance'
            ],
            [
                'id'    => '76',
                'title' => 'governance_edit',
                'display_name' => 'Edit Governance'
            ],
            [
                'id'    => '77',
                'title' => 'governance_delete',
                'display_name' => 'Delete Governance'
            ],
            [
                'id'    => '78',
                'title' => 'governance_show',
                'display_name' => 'Show Governance'
            ],
            [
                'id'    => '79',
                'title' => 'governance_access',
                'display_name' => 'Access Governance'
            ],
            [
                'id'    => '80',
                'title' => 'level_create',
                'display_name' => 'Create Level'
            ],
            [
                'id'    => '81',
                'title' => 'level_edit',
                'display_name' => 'Edit Level'
            ],
            [
                'id'    => '82',
                'title' => 'level_delete',
                'display_name' => 'Delete Level'
            ],
            [
                'id'    => '83',
                'title' => 'level_show',
                'display_name' => 'Show Level'
            ],
            [
                'id'    => '84',
                'title' => 'level_access',
                'display_name' => 'Access Level'
            ],
            [
                'id' => '85',
                'title' => 'access-sub-organization-forms',
                'display_name' => 'Access Sub-organizations Forms'
            ]
        ];

        Permission::insert($permissions);

    }
}
