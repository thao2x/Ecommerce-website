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
        
        foreach($products as $product) {
            for ($i = 0; $i < $faker->randomElement([4, 5]); $i++) {
                $size = 40 + $i;
                Variant::create([
                    'product_id' => $product['id'],
                    'size' => $size,
                ]);
            }
        }
    }
}
