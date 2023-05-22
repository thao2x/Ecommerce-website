<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and 
        // let's hash it before the loop, or else our seeder 
        // will be too slow.
        $password = Hash::make('password');

        User::create([
            'full_name' => 'Administrator',
            'dob' => '09/21/22',
            'email' => 'admin@test.com',
            'password' => $password,
            'avatar' => '\images\user\avatar.jpg'
        ]);
    }
}
