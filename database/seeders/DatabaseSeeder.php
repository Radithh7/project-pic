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
            'email' => 'admin@example.com',
            'password' => Hash::make('admin1234'), // Jangan lupa bcrypt password!
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
