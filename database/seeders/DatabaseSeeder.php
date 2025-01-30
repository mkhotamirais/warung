<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Productcat;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // user
        User::Create([
            'id' => 1,
            'name' => "warungota",
            'email' => "warungota@gmail.com",
            'email_verified_at' => now(),
            'password' => "warungotapass",
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        // productcat
        Productcat::firstOrCreate([
            'id' => 1,
            'name' => 'makanan',
            'slug' => 'makanan'
        ]);
        Productcat::Create([
            'id' => 2,
            'name' => 'minuman',
            'slug' => 'minuman'
        ]);

        // product
        Product::firstOrCreate([
            'id' => 1,
            'name' => 'keripik singkong',
            'slug' => 'keripik-singkong',
            'description' => 'keriping pedas dan tidak pedas dari yang nitip',
            'price' => 2000,
            'price_details' => 'mau yang pedas atau tidak sama sama 2000',
            'productcat_id' => 1,
            'user_id' => 1
        ]);

        Product::Create([
            'id' => 2,
            'name' => 'permen',
            'slug' => 'permen',
            'description' => 'permen macem macem',
            'price' => 2000,
            'price_details' => '250 atau 500 / 2',
            'productcat_id' => 1,
            'user_id' => 1
        ]);
    }
}
