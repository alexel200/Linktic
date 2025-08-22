<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            Product::create([
                'name' => $faker->unique()->words(3, true),
                'description' => $faker->sentence(50),
                'price' => $faker->randomFloat(2, 10, 1000),
                'stock' => $faker->numberBetween(0, 100),
            ]);
        }
    }
}

