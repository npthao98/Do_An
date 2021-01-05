<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [ //1
                'phone' => '0339737700',
                'birthday' => '1998-04-12',
                'gender' => 'female',
                'email' => 'nguyenthao@gmail.com',
                'person_id' => 1,
            ],
            [ //2
                'phone' => '0339737701',
                'birthday' => '1998-04-12',
                'gender' => 'female',
                'email' => 'tranthuy@gmail.com',
                'person_id' => 2,
            ],
            [ //3
                'phone' => '0339737702',
                'birthday' => '1998-04-12',
                'gender' => 'female',
                'email' => 'queanh@gmail.com',
                'person_id' => 3,
            ],
            [ //4
                'phone' => '0339737703',
                'birthday' => '1998-04-12',
                'gender' => 'female',
                'email' => 'tranlanh@gmail.com',
                'person_id' => 4,
            ],
            [ //5
                'phone' => '0339737704',
                'birthday' => '1998-04-12',
                'gender' => 'female',
                'email' => 'nguyenlinh@gmail.com',
                'person_id' => 5,
            ],
            [ //6
                'phone' => '0339737705',
                'birthday' => '1998-04-12',
                'gender' => 'male',
                'email' => 'trinhhuynh@gmail.com',
                'person_id' => 6,
            ],
            [ //7
                'phone' => '0339737706',
                'birthday' => '1998-04-12',
                'gender' => 'female',
                'email' => 'dinhhien@gmail.com',
                'person_id' => 7,
            ],
            [ //8
                'phone' => '0339737707',
                'birthday' => '1998-04-12',
                'gender' => 'female',
                'email' => 'dinhtrang@gmail.com',
                'person_id' => 8,
            ],
            [ //9
                'phone' => '0339737708',
                'birthday' => '1998-04-12',
                'gender' => 'female',
                'email' => 'minhyen@gmail.com',
                'person_id' => 9,
            ],
            [ //10
                'phone' => '0339737709',
                'birthday' => '1998-04-12',
                'gender' => 'male',
                'email' => 'ngochai@gmail.com',
                'person_id' => 10,
            ],
            [ //10
                'phone' => '0339737711',
                'birthday' => '1998-04-12',
                'gender' => 'male',
                'email' => 'admin@gmail.com',
                'person_id' => 11,
            ],
        ]);
    }
}
