<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            [ //1
                'image_employee' => 'avatar.jpg',
                'internal_mail' => 'admin@gmail.com',
                'description' => '5 năm kinh nghiệm, tiếng anh giao tiếp khá.',
                'person_id' => 11,
            ],
        ]);
    }
}
