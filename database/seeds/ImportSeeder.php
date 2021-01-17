<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Import;
use App\Models\ProductInfor;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [ //1
                'name' => 'Moon',
                'address' => 'Hà Đông - Hà nội',
                'description' => 'Moon là một nhãn hàng local của Việt Nam, được hình thành và phát triển từ những năm 1998...',
            ]
        ]);

        DB::table('imports')->insert([
            [ //1
                'date' => '2020-12-01 17:54:32',
                'employee_id' => 1,
                'supplier_id' => 1,
                'total_price' => 0,
            ],
            [ //2
                'date' => '2020-12-01 17:54:32',
                'employee_id' => 1,
                'supplier_id' => 1,
                'total_price' => 0,
            ],
            [ //3
                'date' => '2020-12-01 17:54:32',
                'employee_id' => 1,
                'supplier_id' => 1,
                'total_price' => 0,
            ],
            [ //4
                'date' => '2020-12-01 17:54:32',
                'employee_id' => 1,
                'supplier_id' => 1,
                'total_price' => 0,
            ],
            [ //5
                'date' => '2020-12-01 17:54:32',
                'employee_id' => 1,
                'supplier_id' => 1,
                'total_price' => 0,
            ],
            [ //6
                'date' => '2020-12-01 17:54:32',
                'employee_id' => 1,
                'supplier_id' => 1,
                'total_price' => 0,
            ],
            [ //7
                'date' => '2020-12-01 17:54:32',
                'employee_id' => 1,
                'supplier_id' => 1,
                'total_price' => 0,
            ],
            [ //8
                'date' => '2020-12-01 17:54:32',
                'employee_id' => 1,
                'supplier_id' => 1,
                'total_price' => 0,
            ],
            [ //9
                'date' => '2020-12-01 17:54:32',
                'employee_id' => 1,
                'supplier_id' => 1,
                'total_price' => 0,
            ],
            [ //10
                'date' => '2020-12-01 17:54:32',
                'employee_id' => 1,
                'supplier_id' => 1,
                'total_price' => 0,
            ],
            [ //11
                'date' => '2020-12-01 17:54:32',
                'employee_id' => 1,
                'supplier_id' => 1,
                'total_price' => 0,
            ],
        ]);

        $imports = Import::all();
        $product_infors = ProductInfor::whereIn('product_id', [1, 2])->get();
        foreach ($imports as $import) {
            $total_price = 0;
            foreach ($product_infors as $product_infor) {
                DB::table('item_imports')->insert([
                    [ //1
                        'quantity' => 10,
                        'price_import' => $product_infor->product->price_import,
                        'product_infor_id' => $product_infor->id,
                        'import_id' => $import->id,
                    ]
                ]);
                $total_price = $total_price + 10 * $product_infor->product->price_import;
            }
            $import->update([
                'total_price' => $total_price,
            ]);
        }
    }
}
