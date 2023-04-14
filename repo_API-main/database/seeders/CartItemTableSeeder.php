<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Variant;
use App\Models\Cart_Item;

class CartItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 100; $i++) {
            $customer = Customer::all()->random()->getAttributes();
            $variant = Variant::all()->random()->getAttributes();
            Cart_Item::create([
                'id' => $faker->uuid,
                'customer_id' => $customer['id'],
                'variant_id' => $variant['id'],
                'quantity' => $faker->randomElement([1, 2, 3, 4])
            ]);
        }
    }
}
