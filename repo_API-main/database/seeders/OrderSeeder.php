<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\Shipping_address;
use App\Models\Promo;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $customers = Customer::all();

        foreach($customers as $customer) {
            for ($i = 0; $i < $faker->randomElement([1, 2, 3, 4]); $i++) {
                $shipping = Shipping::all()->random()->getAttributes();
                $promo = Promo::all()->random()->getAttributes();
                $addressId = '';

                foreach($customer->shippingAddress as $address) {
                    if ($address->default_flg == 1) {
                        $addressId = $address->id;
                    }
                }

                Order::create([
                    'customer_id' => $customer->id,
                    'shiping_address_id' => $addressId,
                    'shipping_id' => $shipping['id'],
                    'promo_id' => $promo['id'],
                    'code' => $faker->regexify('[A-Z]{5}[0-4]{5}')
                ]);
            }
        }
    }
}
