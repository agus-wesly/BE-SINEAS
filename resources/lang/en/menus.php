<?php


return [
    'movie' => [
        'title' => 'Film',
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
    'banner' => [
        'title' => 'Banners',
        'permission' => '#',
        'slug' => route('banners.index'),
        'icon' => 'fa-solid fa-font-awesome',
    ],
    'filmSelling' => [
        'title' => 'Rent',
        'permission' => '#',
        'slug' => route('film-selling.index'),
        'icon' => 'fa-solid fa-money-bill',
    ],
    'transaction' => [
        'title' => 'Transaction',
        'permission' => '#',
        'slug' => route('transaction.index'),
        'icon' => 'fa-solid fa-clock-rotate-left',
    ],
    'taxes' => [
        'title' => 'Tax',
        'permission' => '#',
        'slug' => route('taxes.index'),
        'icon' => 'fa-solid fa-usd',
    ],
    'userMaster' => [
        'title' => 'User',
        'permission' => '#',
        'slug' => route('user.index'),
        'icon' => 'fa-solid fa-users',
    ],
    // 'setting' => [
    //     'title' => 'Setting',
    //     'permission' => '#',
    //     'slug' => '#',
    //     'icon' => 'fa-solid fa-gear',
    //     'child' => [
    //         'filmSellingPrice' => [
    //             'title' => 'Film Selling Price',
    //             'permission' => '#',
    //             'slug' => route('film-selling-price.index'),
    //             'icon' => 'fa-solid fa-caret-right',
    //         ],
    //         'role' => [
    //             'title' => 'Roles',
    //             'permission' => '#',
    //             'slug' => route('roles.index'),
    //             'icon' => 'fa-solid fa-caret-right',
    //         ],
    //         'profile' => [
    //             'title' => 'Profile',
    //             'permission' => '#',
    //             'slug' => route('profile.edit'),
    //             'icon' => 'fa-solid fa-caret-right',
    //         ],
    //     ]
    // ],
];
