<?php

return [
    'userManagement'    => [
        'title'          => 'User Management',
        'title_singular' => 'User Management',
    ],
    
    'permission'        => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],

    'role'              => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'can_shareable'              => 'Share with other Users?',
            'can_shareable_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],

    'user'              => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => 'Leave the field empty, if you do not want to change it.',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'organization'            => 'Organizations',
            'organization_helper'      => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
        ],
    ],

    'productManagement'    => [
        'title'          => 'Product Management',
        'title_singular' => 'Product Management',
    ],

    'productCategory'   => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Name',
            'name_helper'        => '',
            'description'        => 'Description',
            'description_helper' => '',
            'photo'              => 'Photo',
            'photo_helper'       => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => '',
            'category'           => 'Parent Category',
            'category_helper'    => '',
            'slug'               => 'Slug',
            'slug_helper'        => '',
        ],
    ],

    'productTag'        => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],

    'product'           => [
        'title'          => 'Products',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Name',
            'name_helper'        => '',
            'price'             =>'Price',
            'price_helper'      =>'',
            'framework'        => 'Framework',
            'framework_helper' => '',
            'published_date'              => 'Published Date',
            'published_date_helper'       => '',
            'category'           => 'Categories',
            'category_helper'    => '',
            'tag'                => 'Tags',
            'tag_helper'         => '',
            'author'             => 'Authors',
            'author_helper'      => '',
            'software_version'               => 'Software Version',
            'software_version_helper'        => '',
            'compatible_browsers'              => 'Compatible Browsers',
            'compatible_browsers_helper'       => '',
            'photo'              => 'Photo',
            'photo_helper'       => '',
            'featured'           => 'Featured',
            'featured_helper'    => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => '',
            'slug'               => 'Slug',
            'slug_helper'        => '',
            'manual'               => 'Manuals',
            'manual_helper'        => '',
            'overview'              =>'Overview',
            'overview_helper'       =>'',
            'features'              =>'Features',
            'features_helper'       =>'',
            'requirements'              =>'Requirements',
            'requirements_helper'       =>'',
            'instructions'              =>'Instructions',
            'instructions_helper'       =>'',
            'license'           => 'License',
            'license_helper'    => '',

        ],
    ],

    'cms'    => [
        'title'          => 'CMS',
        'title_singular' => 'CMS',
    ],

    'slider'           => [
        'title'          => 'Sliders',
        'title_singular' => 'Slider',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Name',
            'name_helper'        => '',
            'status'             => 'Status',
            'status_helper'      => '',
            'photo'              => 'Photo',
            'photo_helper'       => '',
        ],
    ],

    'popup'           => [
        'title'          => 'Popups',
        'title_singular' => 'Popup',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Name',
            'name_helper'        => '',
            'status'             => 'Status',
            'status_helper'      => '',
            'photo'              => 'Photo',
            'photo_helper'       => '',
        ],
    ],

    'subjectarea'           => [
        'title'          => 'Subject Areas',
        'title_singular' => 'Subject Area',
        'fields'         => [
            'id'               => 'ID',
            'id_helper'        => '',
            'title'            => 'Title',
            'title_helper'     => '',
            'sort'             => 'Sort',
            'sort_helper'      => '',
            'slug'             => 'Slug',
            'slug_helper'      => '',
        ],
    ],

    'parameter'           => [
        'title'          => 'Parameters',
        'title_singular' => 'Parameter',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => '',
            'title'                 => 'Title',
            'title_helper'          => '',
            'description'           => 'Description',
            'description_helper'    => '',
            'sort'                  => 'Sort',
            'sort_helper'           => '',
            'subject_area'          => 'Subject Area',
            'subject_area_helper'   => '',
            'slug'                  => 'Slug',
            'slug_helper'           => '',
            'option'                => 'Options',
            'document'              => 'Documents',
        ],
    ],

    'province'           => [
        'title'          => 'Provinces',
        'title_singular' => 'Province',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => '',
            'name'                  => 'Name',
            'name_helper'           => '',
            'district'              => 'District',
        ],
    ],

    'organization'           => [
        'title'          => 'Organizations',
        'title_singular' => 'Organization',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => '',
            'name'                  => 'Name',
            'name_helper'           => '',
            'contact'               => 'Contact',
            'contact_helper'        => '',
            'province'              => 'Province',
            'province_helper'       => '',
            'district'              => 'District',
            'district_helper'       => '',
            'address'               => 'Address',
            'address_helper'        => '',
            'slug'                  => 'Slug',
            'slug_helper'           => '',
        ],
    ],

    'form'           => [
        'title'          => 'Forms',
        'title_singular' => 'Form',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'organization'              => 'Organization',
            'organization_helper'       => '',
            'created_by'                => 'Created By',
            'created_by_helper'         => '',
            'updated_by'                => 'Updated By',
            'updated_by_helper'         => '',
            'audited_by'                => 'Audited By',
            'audited_by_helper'         => '',
            'verified_by'               => 'Verified By',
            'verified_by_helper'        => '',
            'final_verified_by'         => 'Final Verified By',
            'final_verified_by_helper'  => '',
            'year'                      => 'Year',
            'year_helper'               => '',
            
        ],
    ],

];
