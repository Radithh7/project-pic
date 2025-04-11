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
        // User::factory(10)->create();
        User::create([
            'name' => 'Admin Demo',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin1234'),
            'role' => 'admin', 
        ]);
        User::create([
            'name' => 'User Demo',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user1234'),
            'role' => 'user', 
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
    }
}
