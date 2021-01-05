<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductInfor;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::all();
        $customerId = 1;
        $productInforId = 1;
        foreach ($orders as $order) {
            if ($order->customer_id != $customerId) {
                $productInforId = $productInforId - 6;
                $customerId = $order->customer_id;
            }

            $productInfor = ProductInfor::find($productInforId);
            $product = $productInfor->product;

            DB::table('items')->insert([
                [
                    'quantity' => 1,
                    'price_sale' => $product->price_sale,
                    'price_import' => $product->price_import,
                    'product_infor_id' => $productInforId,
                    'order_id' => $order->id,
                ]
            ]);

            $order->update([
                'total_price' => 15000 + $product->price_sale,
            ]);

            $productInforId += 3;
        }
    }
}
