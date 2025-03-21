<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Category::create([
            'category_name' => 'makanan'
        ]);
        Category::create([
            'category_name' => 'minuman'
        ]);
        Category::create([
            'category_name' => 'alat tulis'
        ]);
        Category::create([
            'category_name' => 'atribut sekolah'
        ]);
        Product::create([
            'nameproduct' => 'zaki',
            'categories_id' => 1,
            'description' => 'zaki',
            'stock' => 1,
            'price' => 1000000,
            'image' => 'zaki.png',
        ]);
    }
}
