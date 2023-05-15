<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(VariantsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(ShippingTableSeeder::class);
        $this->call(PromoTableSeeder::class);
        $this->call(ShippingAddressTableSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderItemTableSeeder::class);
        $this->call(CartItemTableSeeder::class);
    }
}
