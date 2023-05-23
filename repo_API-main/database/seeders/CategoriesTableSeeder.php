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
            'image' => '/images/categories/nike_logo.png'
        ]);

        Category::create([
            'name' => 'Puma',
            'image' => '/images/categories/puma_logo.png'
        ]);

        Category::create([
            'name' => 'Addidas',
            'image' => '/images/categories/addidas_logo.png'
        ]);

        Category::create([
            'name' => 'New Balance',
            'image' => '/images/categories/new_balance_logo.png'
        ]);

        Category::create([
            'name' => 'Reebok',
            'image' => '/images/categories/reebok_logo.png'
        ]);

        Category::create([
            'name' => 'Converse',
            'image' => '/images/categories/converse_logo.webp'
        ]);
    }
}
