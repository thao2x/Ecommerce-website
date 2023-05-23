<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $password = Hash::make('password');

        Customer::create([
            'full_name' => $faker->name,
            'nick_name' => $faker->name,
            'dob' => '00/00/0000',
            'email' => $faker->email,
            'password' => $password,
            'phone' => '0123456781',
            'gender' => $faker->randomElement(['male', 'female']),
            'avatar' => '\images\customers\customer_1.jpg',
            'pin' => '1111'
        ]);

        Customer::create([
            'full_name' => $faker->name,
            'nick_name' => $faker->name,
            'dob' => '00/00/0000',
            'email' => $faker->email,
            'password' => $password,
            'phone' => '0123456782',
            'gender' => $faker->randomElement(['male', 'female']),
            'avatar' => '\images\customers\customer_2.jpg',
            'pin' => '1111'
        ]);

        Customer::create([
            'full_name' => $faker->name,
            'nick_name' => $faker->name,
            'dob' => '00/00/0000',
            'email' => $faker->email,
            'password' => $password,
            'phone' => '0123456783',
            'gender' => $faker->randomElement(['male', 'female']),
            'avatar' => '\images\customers\customer_3.jpg',
            'pin' => '1111'
        ]);

        Customer::create([
            'full_name' => $faker->name,
            'nick_name' => $faker->name,
            'dob' => '00/00/0000',
            'email' => $faker->email,
            'password' => $password,
            'phone' => '0123456784',
            'gender' => $faker->randomElement(['male', 'female']),
            'avatar' => '\images\customers\customer_4.jpg',
            'pin' => '1111'
        ]);

        Customer::create([
            'full_name' => $faker->name,
            'nick_name' => $faker->name,
            'dob' => '00/00/0000',
            'email' => $faker->email,
            'password' => $password,
            'phone' => '0123456785',
            'gender' => $faker->randomElement(['male', 'female']),
            'avatar' => '\images\customers\customer_5.jpg',
            'pin' => '1111'
        ]);

        Customer::create([
            'full_name' => $faker->name,
            'nick_name' => $faker->name,
            'dob' => '00/00/0000',
            'email' => $faker->email,
            'password' => $password,
            'phone' => '0123456786',
            'gender' => $faker->randomElement(['male', 'female']),
            'avatar' => '\images\customers\customer_6.jpg',
            'pin' => '1111'
        ]);
    }
}
