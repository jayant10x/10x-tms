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

    'all_tasks' => [
        'route' => 'all_tasks',
        'icon' => 'ri-list-check-3',
        'label' => 'All Tasks',
    ],

    'all_my_tasks' => [
        'route' => 'all_my_tasks',
        'icon' => 'ri-user-follow-line',
        'label' => 'Assigned To Me',
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

        'all_tasks' => [
            ...$main_permission_arr['all_tasks'],
            'permissions' => [
                'add' => false,
                'edit' => false,
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

        'all_tasks' => [
            ...$main_permission_arr['all_tasks'],
            'permissions' => [
                'add' => true,
                'edit' => false,
                'view' => true,
                'delete' => false,
            ],
        ],

        'all_my_tasks' => [
            ...$main_permission_arr['all_my_tasks'],
            'permissions' => [
                'add' => false,
                'edit' => true,
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

        'all_my_tasks' => [
            ...$main_permission_arr['all_my_tasks'],
            'permissions' => [
                'add' => false,
                'edit' => true,
                'view' => true,
                'delete' => false,
            ],
        ],
    ],
];


return $permission_arr;
