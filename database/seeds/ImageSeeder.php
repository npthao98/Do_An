<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
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
            DB::table('images')->insert([
                [
                    'link_to_image' => 'product_' . $product->id . '_1.jpg',
                    'product_id' => $product->id,
                ],
                [
                    'link_to_image' => 'product_' . $product->id . '_2.jpg',
                    'product_id' => $product->id,
                ],
                [
                    'link_to_image' => 'product_' . $product->id . '_3.jpg',
                    'product_id' => $product->id,
                ],
                [
                    'link_to_image' => 'product_' . $product->id . '_4.jpg',
                    'product_id' => $product->id,
                ],
            ]);
        }
    }
}
