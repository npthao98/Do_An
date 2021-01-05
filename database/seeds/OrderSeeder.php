<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = Customer::all();
        foreach ($customers as $customer) {
            $person = $customer->person;
            $k = 5;
            while ($k-- > 0) {
                DB::table('orders')->insert([
                    [
                        'time' => '2020-12-01 17:54:32',
                        'status' => 2,
                        'address' => $customer->id . '/6 - đường 18m - Hà Đông - Hà Nội',
                        'receiver' => $person->first_name . ' ' . $person->midd_name . ' ' . $person->last_name,
                        'phone' => $customer->phone,
                        'fee_shipment' => 15000,
                        'type_shipment' => 'normal',
                        'status_payment' => 0,
                        'type_payment' => 'COD',
                        'total_price' => 0,
                        'customer_id' => $customer->id,
                    ]
                ]);
            }
        }
    }
}
