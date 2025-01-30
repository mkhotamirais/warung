<?php

return [
    "menu" => [
        ['name' => 'Dashboard', 'route' => 'dashboard'],
        ['name' => 'Product', 'route' => 'products.index'],
        ['name' => 'Product Category', 'route' => 'productcats.index'],
        ['name' => 'Users', 'route' => 'users']
    ],
    'sorting-price' => [
        '' => 'Default',
        'cheapest' => 'Termurah',
        'most-expensive' => 'Termahal',
        'latest' => 'Terbaru',
        'oldest' => 'Terlama',
        'a-z' => 'A-Z',
        'z-a' => 'Z-A'
    ],
];
