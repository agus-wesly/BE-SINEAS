<?php


return [
    'setting' => [
        'title' => 'Setting',
        'permission' => '#',
        'slug' => '#',
        'icon' => 'fa-solid fa-users',
        'child' => [
            'role' => [
                'title' => 'Roles',
                'permission' => '#',
                'slug' => route('roles.index'),
                'icon' => 'fa-solid fa-caret-right',
            ],
            'userTerdaftar' => [
                'title' => 'User Terdaftar',
                'permission' => '#',
                'slug' => '#',
                'icon' => 'fa-solid fa-caret-right',
            ],
        ]
    ],
];
