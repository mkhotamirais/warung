<?php

return [
    "meta" => [
        "title" => env('APP_NAME'),
        "description" => "WarungOta adalah platform e-commerce yang menyediakan berbagai kebutuhan sehari-hari seperti makanan, minuman, alat kebersihan, obat-obatan, dan produk kecantikan dengan harga terjangkau. Temukan produk favorit Anda di WarungOta!",
        "keywords" => "WarungOta, Warung Bu Yanti, Ota Photocopy, Nurul Iman Sindangkerta, belanja online, kebutuhan harian, makanan, minuman, alat kebersihan, obat-obatan, toko online, Bandung Barat",
    ],
    "links" => [
        "wa" => "https://wa.me/6281234567890",
    ],
    "menu" => [
        ['name' => 'Dashboard', 'route' => 'dashboard'],
        ['name' => 'Product', 'route' => 'products.index'],
        ['name' => 'Product Category', 'route' => 'productcats.index'],
        ['name' => 'Blog', 'route' => 'blogs.index'],
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
