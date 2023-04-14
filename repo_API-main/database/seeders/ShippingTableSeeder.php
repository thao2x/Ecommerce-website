<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shipping;

class ShippingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        Shipping::create([
            'id' => $faker->uuid,
            'name' => 'COD',
            'description' => 'Cash on Delivery (COD)',
            'price' => 550
        ]);
    }
}
