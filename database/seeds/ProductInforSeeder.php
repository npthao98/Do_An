<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductInforSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        foreach ($products as $product) {
            DB::table('product_infors')->insert([
               'size' => 'S',
               'color' => 'N/A',
               'quantity' => '20',
               'product_id' => $product->id,
            ]);
            DB::table('product_infors')->insert([
                'size' => 'M',
                'color' => 'N/A',
                'quantity' => '15',
                'product_id' => $product->id,
            ]);
            DB::table('product_infors')->insert([
                'size' => 'L',
                'color' => 'N/A',
                'quantity' => '30',
                'product_id' => $product->id,
            ]);
        }
    }
}
