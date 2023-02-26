<?php

use Intervention\Image\Gd\Commands\RotateCommand;

return [
    'user' => [
        'title' => 'Mitra Leu',
        'permission' => '#',
        'slug' => '#',
        'icon' => 'fa-solid fa-users',
        'child' => [
            'pendaftar' => [
                'title' => 'Pendaftar',
                'permission' => '#',
                'slug' => '#',
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
