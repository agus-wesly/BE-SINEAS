<?php


return [
    'setting' => [
        'title' => 'Setting',
        'permission' => '#',
        'slug' => '#',
        'icon' => 'fa-solid fa-gear',
        'child' => [
            'taxes' => [
                'title' => 'Pajak',
                'permission' => '#',
                'slug' => route('taxes.index'),
                'icon' => 'fa-solid fa-caret-right',
            ],
            'role' => [
                'title' => 'Roles',
                'permission' => '#',
                'slug' => route('roles.index'),
                'icon' => 'fa-solid fa-caret-right',
            ],
            'profile' => [
                'title' => 'Profile',
                'permission' => '#',
                'slug' => route('profile.edit'),
                'icon' => 'fa-solid fa-caret-right',
            ],
        ]
    ],
    'movie' => [
        'title' => 'Movie',
        'permission' => '#',
        'slug' => route('movie.index'),
        'icon' => 'fa-solid fa-film',
    ],
    'genre' => [
        'title' => 'Genre',
        'permission' => '#',
        'slug' => route('genre.index'),
        'icon' => 'fa-solid fa-list-alt',
    ],
    'userMaster' => [
        'title' => 'User Master',
        'permission' => '#',
        'slug' => route('user.index'),
        'icon' => 'fa-solid fa-users',
    ],
];
