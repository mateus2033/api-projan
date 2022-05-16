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
        DB::table('products')->insert([
            'name' => 'Feijão',
            'price' => '5,00',
            'validate' => '20230101',
            'category_id' => null,
            'brand_id' => null
        ]);

        DB::table('products')->insert([
         
            'name' => 'Chocolate de Norte',
            'price' => '3,50',
            'validate' => '20220511',
            'category_id' => null,
            'brand_id' => null
     
        ]);

        DB::table('products')->insert([
         
            'name' => 'Agua de Soja 2L',
            'price' => '2,00',
            'validate' => '20220101',
            'category_id' => null,
            'brand_id' => null
     
        ]);

        DB::table('products')->insert([
         
            'name' => 'Elixir da Vida',
            'price' => '12,99',
            'validate' => '20250101',
            'category_id' => null,
            'brand_id' => null
     
        ]);
    }
}
