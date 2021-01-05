<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\ProductInfor;
use App\Models\Order;
use App\Models\Product;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::all();
        foreach ($items as $item) {
            $productInfor = ProductInfor::find($item->product_infor_id);
            $product = $productInfor->product;
            $order = Order::find($item->order_id);
            DB::table('rates')->insert([
                [
                    'rate' => random_int(3, 5),
                    'comment' => 'Màu đẹp, dáng chuẩn',
                    'product_id' => $product->id,
                    'customer_id' => $order->customer_id,
                ]
            ]);
        }

        $products = Product::all();
        foreach ($products as $product) {
            $numberOfRates = $product->rates()->count();
            $totalOfRates = $product->rates()->sum('rate');
            if ($totalOfRates > 0) {
                $rate = $totalOfRates / $numberOfRates;
                $product->update([
                    'rate' => $rate,
                ]);
            }
        }
    }
}
