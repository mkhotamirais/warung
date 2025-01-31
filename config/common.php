<?php

return [
    "menu" => [
        ['name' => 'Dashboard', 'route' => 'dashboard'],
        ['name' => 'Product', 'route' => 'products.index'],
        ['name' => 'Product Category', 'route' => 'productcats.index'],
        ['name' => 'Users', 'route' => 'users']
    ],
    'sorting' => [
        '' => 'Default',
        'termurah' => 'Termurah',
        'termahal' => 'Termahal',
        'terbaru' => 'Terbaru',
        'terlama' => 'Terlama',
        'a-z' => 'A-Z',
        'z-a' => 'Z-A'
    ],
    'filter-image' => [
        'dengan-image' => 'Dengan Gambar',
        'tanpa-image' => 'Tanpa Gambar',
    ]
];
