<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Variant;

class VariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $products = Product::all();

        foreach ($products as $product) {
            for ($i = 0; $i < $faker->randomElement([5, 12, 6, 10]); $i++) {
                Variant::create([
                    'product_id' => $product['id'],
                    'size' => $faker->randomElement(['38' ,'39', '40', '41', '42', '43']),
                ]);
            }
        }
    }
}
