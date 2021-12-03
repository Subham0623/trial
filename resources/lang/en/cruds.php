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
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
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
    'cms'    => [
        'title'          => 'CMS',
        'title_singular' => 'CMS',
    ],
    'productCategory'   => [
        'title'          => 'Menus',
        'title_singular' => 'Menu',
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

    'author'           => [
        'title'          => 'Authors',
        'title_singular' => 'Author',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Name',
            'name_helper'        => '',
            'short_bio'        => 'Short bio',
            'short_bio_helper' => '',
            'gender'              => 'Gender',
            'gender_helper'       => '',
            'photo'              => 'Photo',
            'photo_helper'       => '',
            'slug'               => 'Slug',
            'slug_helper'        => '',
        ],
    ],

    'book'           => [
        'title'          => 'Books',
        'title_singular' => 'Book',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'               => 'Title',
            'title_helper'        => '',
            'book'        => 'Book',
            'book_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => '',
            
    

        ],
    ],

    'level'        => [
        'title'          => 'Levels',
        'title_singular' => 'Level',
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

    'review'        => [
        'title'          => 'Reviews',
        'title_singular' => 'Review',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'review'            => 'Title',
            'review_helper'     => '',
            'type'              =>'Type',
            'type_helper'       =>'',
            'status'            =>'Status',
            'status_helper'     =>'',
            'user'              =>'User',
            'user_helper'       =>'',
            'product'           =>'Product',
            'product_helper'    =>'',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
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

    'license'   => [
        'title'          => 'Licenses',
        'title_singular' => 'License',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Name',
            'name_helper'        => '',
            'details'           => 'Details',
            'details_helper'    => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => '',
            'slug'               => 'Slug',
            'slug_helper'        => '',
            
        ],
    ],

    'support'   => [
        'title'          => 'Supports',
        'title_singular' => 'Support',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'product'               => 'Product',
            'product_helper'        => '',
            'details'           => 'Details',
            'details_helper'    => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => '',
            'slug'               => 'Slug',
            'slug_helper'        => '',
            
        ],
    ],
];
