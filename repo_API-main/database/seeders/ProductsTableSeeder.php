<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            $user = User::all()->random()->getAttributes();
            $category = Category::all()->random()->getAttributes();
            Product::create([
                'id' => $faker->uuid,
                'category_id' => $category['id'],
                'user_id' => $user['id'],
                'name' => 'Shoes _ '.$faker->regexify('[A-Z]{5}[0-4]{3}'),
                'type' => $faker->randomElement([1, 2]),
                'price' => $faker->numberBetween($min = 1500, $max = 6000),
                'description' =>$faker->paragraph,
                'rating' => $faker->randomElement([1, 2, 3, 4, 5])
            ]);
        }
    }
}
