<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Variant;
use App\Models\CartItem;

class CartItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        $customers = Customer::all();

        foreach ($customers as $customer) {
            for ($i = 0; $i < $faker->randomElement([5, 2, 6, 1]); $i++) {
                $variant = Variant::all()->random()->getAttributes();
                CartItem::create([
                    'customer_id' => $customer['id'],
                    'variant_id' => $variant['id'],
                    'quantity' => $faker->randomElement([1, 2, 3, 4])
                ]);
            }
        }
    }
}
