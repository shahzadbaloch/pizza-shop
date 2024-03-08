<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberName = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
        for ($i = 0; $i <= 5; $i++) {
            $isAddon = rand(0, 1);

            DB::table('products')->insert([
                'name' => "Product " . $numberName[$i],
                'is_addon' => $isAddon,
                'description' => 'Product Description',
                'price' => rand(100, 500),
                'image' => "assets/img/products/product-" . $numberName[$i] . ".png",
            ]);
        }

        for ($i = 0; $i <= 8; $i++) {
            DB::table('addons')->insert([
                'name' => "Addon " . $numberName[$i],
                'description' => 'Addon Description',
                'price' => rand(50, 150),
                'image' => "assets/img/addon/addon-" . $numberName[$i] . ".png",
            ]);
        }
    }
}
