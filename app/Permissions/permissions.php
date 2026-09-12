<?php

$main_permission_arr = [

    'dashboard' => [
        'route' => 'dashboard',
        'icon' => 'ri-dashboard-2-line',
        'label' => 'Dashboard',
    ],

    'employees' => [
        'route' => 'employees.list',
        'icon' => 'ri-contacts-book-3-line',
        'label' => 'Employees',
    ],

    'admin_users' => [
        'route' => 'admin_user_module.list',
        'icon' => 'ri-shield-user-line',
        'label' => 'Admin User',
    ],

    'team_members' => [
        'route' => 'team_members.list',
        'icon' => 'ri-team-line',
        'label' => 'Team Members',
    ],

    'projects' => [
        'route' => 'projects.list',
        'icon' => 'ri-briefcase-2-line',
        'label' => 'Projects',
    ],
];


$permission_arr = [

    'admin' => [
        'dashboard' => [
            ...$main_permission_arr['dashboard'],
            'permissions' => [
                'add' => true,
                'edit' => true,
                'view' => true,
                'delete' => true,
            ],
        ],

        'employees' => [
            ...$main_permission_arr['employees'],
            'permissions' => [
                'add' => true,
                'edit' => true,
                'view' => true,
                'delete' => true,
            ],
        ],

        'admin_users' => [
            ...$main_permission_arr['admin_users'],
            'permissions' => [
                'add' => true,
                'edit' => true,
                'view' => true,
                'delete' => true,
            ],
        ],

        'team_members' => [
            ...$main_permission_arr['team_members'],
            'permissions' => [
                'add' => true,
                'edit' => true,
                'view' => true,
                'delete' => true,
            ],
        ],

        'projects' => [
            ...$main_permission_arr['projects'],
            'permissions' => [
                'add' => true,
                'edit' => true,
                'view' => true,
                'delete' => true,
            ],
        ],
    ],

    'manager' => [
        'dashboard' => [
            ...$main_permission_arr['dashboard'],
            'permissions' => [
                'add' => true,
                'edit' => true,
                'view' => true,
                'delete' => true,
            ],
        ],

        'team_members' => [
            ...$main_permission_arr['team_members'],
            'permissions' => [
                'add' => false,
                'edit' => true,
                'view' => true,
                'delete' => false,
            ],
        ],

        'projects' => [
            ...$main_permission_arr['projects'],
            'permissions' => [
                'add' => true,
                'edit' => false,
                'view' => true,
                'delete' => false,
            ],
        ],
    ],


    'employee' => [

        'dashboard' => [
            ...$main_permission_arr['dashboard'],
            'permissions' => [
                'add' => false,
                'edit' => false,
                'view' => true,
                'delete' => false,
            ],
        ],

        'projects' => [
            ...$main_permission_arr['projects'],
            'permissions' => [
                'add' => false,
                'edit' => false,
                'view' => true,
                'delete' => false,
            ],
        ],
    ],
];


return $permission_arr;
