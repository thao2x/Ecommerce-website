<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        Category::create([
            'name' => 'Nike',
            'image' => '/categories/nike_logo.png'
        ]);

        Category::create([
            'name' => 'Puma',
            'image' => '/categories/puma_logo.png'
        ]);

        Category::create([
            'name' => 'Addidas',
            'image' => '/categories/addidas_logo.png'
        ]);

        Category::create([
            'name' => 'New Balance',
            'image' => '/categories/new_balance_logo.png'
        ]);

        Category::create([
            'name' => 'Reebok',
            'image' => '/categories/reebok_logo.png'
        ]);

        Category::create([
            'name' => 'Converse',
            'image' => '/categories/converse_logo.webp'
        ]);
    }
}
