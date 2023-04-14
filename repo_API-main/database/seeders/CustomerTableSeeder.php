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
            'id' => $faker->uuid,
            'full_name' => $faker->name,
            'nick_name' => $faker->name,
            'dob' => '00/00/0000',
            'email' => $faker->email,
            'password' => $password,
            'phone' => '0123456781',
            'gender' => $faker->randomElement(['male', 'female']),
            'avatar' => 'https://i.pinimg.com/originals/c4/20/f9/c420f9bec9be8fa4a4e453dae12976e0.jpg',
            'pin' => '1111'
        ]);

        Customer::create([
            'id' => $faker->uuid,
            'full_name' => $faker->name,
            'nick_name' => $faker->name,
            'dob' => '00/00/0000',
            'email' => $faker->email,
            'password' => $password,
            'phone' => '0123456782',
            'gender' => $faker->randomElement(['male', 'female']),
            'avatar' => 'https://i.pinimg.com/originals/39/0c/c4/390cc4cfcf91d382fd60c8f4c56de062.jpg',
            'pin' => '1111'
        ]);

        Customer::create([
            'id' => $faker->uuid,
            'full_name' => $faker->name,
            'nick_name' => $faker->name,
            'dob' => '00/00/0000',
            'email' => $faker->email,
            'password' => $password,
            'phone' => '0123456783',
            'gender' => $faker->randomElement(['male', 'female']),
            'avatar' => 'https://i.pinimg.com/originals/50/25/c9/5025c986369e95165b9ed12436255479.jpg',
            'pin' => '1111'
        ]);

        Customer::create([
            'id' => $faker->uuid,
            'full_name' => $faker->name,
            'nick_name' => $faker->name,
            'dob' => '00/00/0000',
            'email' => $faker->email,
            'password' => $password,
            'phone' => '0123456784',
            'gender' => $faker->randomElement(['male', 'female']),
            'avatar' => 'https://i.pinimg.com/originals/c2/52/d4/c252d4a0cdfdd87ef9db9a7149697b88.jpg',
            'pin' => '1111'
        ]);

        Customer::create([
            'id' => $faker->uuid,
            'full_name' => $faker->name,
            'nick_name' => $faker->name,
            'dob' => '00/00/0000',
            'email' => $faker->email,
            'password' => $password,
            'phone' => '0123456785',
            'gender' => $faker->randomElement(['male', 'female']),
            'avatar' => 'https://i.pinimg.com/originals/31/ff/45/31ff45defb6d5785bc11f3ad1b92dd64.jpg',
            'pin' => '1111'
        ]);

        Customer::create([
            'id' => $faker->uuid,
            'full_name' => $faker->name,
            'nick_name' => $faker->name,
            'dob' => '00/00/0000',
            'email' => $faker->email,
            'password' => $password,
            'phone' => '0123456786',
            'gender' => $faker->randomElement(['male', 'female']),
            'avatar' => 'https://i.pinimg.com/originals/d9/19/7a/d9197a962e07ac58619f14452b5378a9.jpg',
            'pin' => '1111'
        ]);

    }
}
