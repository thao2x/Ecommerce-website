<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;
use Carbon\Carbon;

class PromoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            $percentage = $faker->randomElement([10, 20]);
            Promo::create([
                'id' => $faker->uuid,
                'name' => $faker->regexify('[A-Z]{5}[0-4]{5}'),
                'description' => "Giảm " . $percentage . " toàn bộ đơn hàng.",
                'published_at' => Carbon::now(),
                'percentage' => $percentage
            ]);
        }
    }
}
