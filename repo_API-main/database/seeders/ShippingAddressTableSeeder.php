<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingAddress;
use App\Models\Customer;

class ShippingAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $customers = Customer::all();

        foreach ($customers as $customer) {
            ShippingAddress::create([
                'id' => $faker->uuid,
                'customer_id' => $customer->id,
                'name' => $faker->randomElement(['Da nang', 'Quang Nam', 'Binh Dinh']),
                'details' => $faker->randomElement(['02 Quang Trung, Hai Chau, Đà Nẵng', 'Điện Thắng, Điện bàn, Quảng Nam', 'Mỹ Trang, Mỹ Châu, Phù Mỹ, Binh Dinh']),
                'default_flg' => 1
            ]);
        }
    }
}
