<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persons')->insert([
            [ //1
                'username' => 'NguyenThao',
                'password' => bcrypt('password'),
                'first_name' => 'Nguyễn',
                'midd_name' => 'Phương',
                'last_name' => 'Thảo',
                'status' => 1,
            ],
            [ //2
                'username' => 'TranThuy',
                'password' => bcrypt('password'),
                'first_name' => 'Trần',
                'midd_name' => 'Thanh',
                'last_name' => 'Thuỷ',
                'status' => 1,
            ],
            [ //3
                'username' => 'QueAnh',
                'password' => bcrypt('password'),
                'first_name' => 'Đặng',
                'midd_name' => 'Quế',
                'last_name' => 'Anh',
                'status' => 1,
            ],
            [ //4
                'username' => 'TranLanh',
                'password' => bcrypt('password'),
                'first_name' => 'Trần',
                'midd_name' => 'Thị',
                'last_name' => 'Lanh',
                'status' => 1,
            ],
            [ //5
                'username' => 'NguyenLinh',
                'password' => bcrypt('password'),
                'first_name' => 'Nguyễn',
                'midd_name' => 'Thị',
                'last_name' => 'Linh',
                'status' => 1,
            ],
            [ //6
                'username' => 'TrinhHuynh',
                'password' => bcrypt('password'),
                'first_name' => 'Trịnh',
                'midd_name' => 'Thế',
                'last_name' => 'Huynh',
                'status' => 1,
            ],
            [ //7
                'username' => 'DinhHuyen',
                'password' => bcrypt('password'),
                'first_name' => 'Đinh',
                'midd_name' => 'Thị',
                'last_name' => 'Hiền',
                'status' => 1,
            ],
            [ //8
                'username' => 'DinhTrang',
                'password' => bcrypt('password'),
                'first_name' => 'Đinh',
                'midd_name' => 'Thị Huyền',
                'last_name' => 'Trang',
                'status' => 1,
            ],
            [ //9
                'username' => 'MinhYen',
                'password' => bcrypt('password'),
                'first_name' => 'Nguyễn',
                'midd_name' => 'Thị Minh',
                'last_name' => 'Yến',
                'status' => 1,
            ],
            [ //10
                'username' => 'NgocHai',
                'password' => bcrypt('password'),
                'first_name' => 'Nguyễn',
                'midd_name' => 'Ngọc',
                'last_name' => 'Hải',
                'status' => 1,
            ],
            [ //11
                'username' => 'Admin',
                'password' => bcrypt('password'),
                'first_name' => 'Nguyễn',
                'midd_name' => 'Ngọc',
                'last_name' => 'Khánh',
                'status' => 1,
            ],
        ]);
    }
}
