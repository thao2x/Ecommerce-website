<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $products = Product::all();

        foreach ($products as $product) {
            for ($i = 0; $i < $faker->randomElement([4, 5]); $i++) {
                Image::create([
                    'product_id' => $product['id'],
                    'src' => $faker->randomElement(['\images\products\photo-1.png',
                                                    '\images\products\photo-2.png',
                                                    '\images\products\photo-3.png',
                                                    '\images\products\photo-4.png',
                                                    '\images\products\photo-5.png'])
                ]);
            }
        }
    }
}
