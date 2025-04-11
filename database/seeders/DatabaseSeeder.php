<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::create([
            'nameproduct' => 'Zaki',
            'categories_id' => '1',
            'description' => 'Ini zaki',
            'stock' => '100',
            'price' => '10000',
            'image' => 'zaki.png'
        ]);
        Category::create([
            'category_name' => 'Makanan'
        ]);
        Category::create([
            'category_name' => 'Minuman'
        ]);
        Category::create([
            'category_name' => 'Alat Tulis'
        ]);
        Category::create([
            'category_name' => 'Atribut Sekolah'
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => bcrypt('user'),
        ]);

    }
}
