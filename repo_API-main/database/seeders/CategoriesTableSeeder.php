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
            'image' => 'https://1000logos.net/wp-content/uploads/2021/11/Nike-Logo.png'
        ]);

        Category::create([
            'name' => 'Puma',
            'image' => 'https://w7.pngwing.com/pngs/527/442/png-transparent-puma-logo-iron-on-adidas-brand-adidas-mammal-cat-like-mammal-carnivoran.png'
        ]);

        Category::create([
            'name' => 'Addidas',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/Adidas_Logo.svg/1000px-Adidas_Logo.svg.png'
        ]);

        Category::create([
            'name' => 'New Balance',
            'image' => 'https://logos-world.net/wp-content/uploads/2020/09/New-Balance-Emblem.png'
        ]);

        Category::create([
            'name' => 'Reebok',
            'image' => 'https://seeklogo.com/images/R/reebok-logo-B8CC638372-seeklogo.com.png'
        ]);

        Category::create([
            'name' => 'Converse',
            'image' => 'https://file.hstatic.net/200000384421/file/converse-logo-700x394_74e0f1a4d9fa4bc2b220945592e85730_1024x1024.png'
        ]);
    }
}
