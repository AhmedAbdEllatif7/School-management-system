<?php

namespace Database\Seeders;

use App\Models\Blood;
use App\Models\Nationality;
use App\Models\Parentt;
use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('parents')->delete();

        $names = [
            ['en' => 'John Smith', 'ar' => 'جون سميث'],
            ['en' => 'Alice Johnson', 'ar' => 'أليس جونسون'],
            ['en' => 'David Brown', 'ar' => 'ديفيد براون'],
            // Add more names as needed
        ];

        // ... existing code

foreach ($names as $index => $name) {
    $my_parents = new Parentt();
    $my_parents->email = 'samir.gamal77_' . $index . '@yahoo.com'; // Modify the email to make it unique
    $my_parents->password = Hash::make('12345678');
    $my_parents->father_name = $name; // Assuming the 'en' key holds English names
    $my_parents->father_national_id = '1234567810';
    $my_parents->father_passport_id = '1234567810';
    $my_parents->father_phone = '1234567810';
    $my_parents->father_job = 'programmer'; // Assuming it's a string field
    $my_parents->father_nationality = Nationality::all()->unique()->random()->id;
    $my_parents->father_blood_type = Blood::all()->unique()->random()->id;
    $my_parents->father_religion = Religion::all()->unique()->random()->id;
    $my_parents->father_address = 'القاهرة';
    $my_parents->mother_name = $name['en']; // Assuming the 'en' key holds English names
    $my_parents->mother_national_id = '1234567810';
    $my_parents->mother_passport_id = '1234567810';
    $my_parents->mother_phone = '1234567810';
    $my_parents->mother_job = 'Teacher'; // Assuming it's a string field
    $my_parents->mother_nationality = Nationality::all()->unique()->random()->id;
    $my_parents->mother_blood_type = Blood::all()->unique()->random()->id;
    $my_parents->mother_religion = Religion::all()->unique()->random()->id;
    $my_parents->mother_address = 'القاهرة';
    $my_parents->save();
}

    }


}
