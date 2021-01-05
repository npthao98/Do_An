<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Person;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $persons = Person::all();
        foreach ($persons as $person) {
            DB::table('addresses')->insert([
                [
                    'apartment_number' => $person->id,
                    'street' => '18m',
                    'district' => 'Hà Đông',
                    'city' => 'Hà Nội',
                    'person_id' => $person->id,
                ]
            ]);
        }
    }
}
