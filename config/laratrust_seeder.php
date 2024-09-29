<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'administrator'  => [
            'users'              => 'c,r,u,d',
            'sms'                => 'c,r,u,d',
            'sensors'            => 'c,r,u,d',
            'units'              => 'c,r,u,d',
            'categories'         => 'c,r,u,d',
            'courses'            => 'c,r,u,d',
            'assets'             => 'c,r,u,d',
            'asset-turnovers'    => 'c,r,u,d',
            'userlogs'           => 'r',
        ],
        'user-manager' => [
            'users'              => 'c,r,u,d',
        ],
        'sms-manager' => [
            'sms'                => 'c,r,u,d',
        ],

        'qa-manager' => [
            'units'              => 'c,r,u,d',
            'categories'         => 'c,r,u,d',
            'courses'            => 'c,r,u,d',
        ],

        'asset-manager' => [
            'assets'             => 'c,r,u,d',
            'asset-turnovers'    => 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
