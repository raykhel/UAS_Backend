<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Product')->insert([
            [
                'name' => 'Product 1',
                'type' => 'Elektronik',
                'description' => 'Product 1 description',
                'sell_price' => 1000000.00,
                'buy_price' => 800000.00,
                'photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 2',
                'type' => 'Pakaian',
                'description' => 'Product 2 description',
                'sell_price' => 200000.00,
                'buy_price' => 150000.00,
                'photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 3',
                'type' => 'Peralatan Rumah Tangga',
                'description' => 'Product 3 description',
                'sell_price' => 300000.00,
                'buy_price' => 250000.00,
                'photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
