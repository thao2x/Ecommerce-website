<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Variant;
use App\Models\Order;

class OrderItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $order = Order::all()->random()->getAttributes();
            $variant = Variant::all()->random()->getAttributes();
            OrderItem::create([
                'variant_id' => $variant['id'],
                'order_id' => $order['id'],
                'quantity' => $faker->randomElement([1, 2, 3, 4])
            ]);
        }
    }
}
