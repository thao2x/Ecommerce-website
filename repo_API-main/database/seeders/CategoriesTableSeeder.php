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
            'id' => $faker->uuid,
            'name' => 'Nike',
            'image' => 'https://1000logos.net/wp-content/uploads/2021/11/Nike-Logo.png'
        ]);

        Category::create([
            'id' => $faker->uuid,
            'name' => 'Puma',
            'image' => 'https://staticc.sportskeeda.com/editor/2023/03/bda84-16779522739911-1920.jpg'
        ]);

        Category::create([
            'id' => $faker->uuid,
            'name' => 'Addidas',
            'image' => 'https://graffica.info/wp-content/uploads/2022/12/Adidas-Logo-1971.jpeg'
        ]);

        Category::create([
            'id' => $faker->uuid,
            'name' => 'Bitis',
            'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-Bitis.png'
        ]);
    }
}
