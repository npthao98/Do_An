<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [ //1
                'name' => 'Váy',
                'fullpath' => null,
            ],
            [ //2
                'name' => 'Quần',
                'fullpath' => null,
            ],
            [ //3
                'name' => 'Áo',
                'fullpath' => null,
            ],
            [ //4
                'name' => 'Áo cộc tay',
                'fullpath' => '3',
            ],
            [ //5
                'name' => 'Áo sơ mi',
                'fullpath' => '3',
            ],
            [ //6
                'name' => 'Quần dài',
                'fullpath' => '2',
            ],
            [ //7
                'name' => 'Váy dài',
                'fullpath' => '1',
            ],
            [ //8
                'name' => 'Chân váy',
                'fullpath' => '1',
            ],
            [ //9
                'name' => 'Quần sort',
                'fullpath' => '2',
            ],
        ]);
    }
}
