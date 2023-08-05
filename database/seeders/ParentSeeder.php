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

        foreach ($names as $index => $name) {
            $my_parents = new Parentt();
            $my_parents->email = 'samir.gamal77_' . $index . '@yahoo.com'; // Modify the email to make it unique
            $my_parents->password = Hash::make('12345678');
            $my_parents->Name_Father = $name;
            $my_parents->National_ID_Father = '1234567810';
            $my_parents->Passport_ID_Father = '1234567810';
            $my_parents->Phone_Father = '1234567810';
            $my_parents->Job_Father = ['en' => 'programmer', 'ar' => 'مبرمج'];
            $my_parents->Nationality_Father_id = Nationality::all()->unique()->random()->id;
            $my_parents->Blood_Type_Father_id = Blood::all()->unique()->random()->id;
            $my_parents->Religion_Father_id = Religion::all()->unique()->random()->id;
            $my_parents->Address_Father = 'القاهرة';
            $my_parents->Name_Mother = $name;
            $my_parents->National_ID_Mother = '1234567810';
            $my_parents->Passport_ID_Mother = '1234567810';
            $my_parents->Phone_Mother = '1234567810';
            $my_parents->Job_Mother = ['en' => 'Teacher', 'ar' => 'معلمة'];
            $my_parents->Nationality_Mother_id = Nationality::all()->unique()->random()->id;
            $my_parents->Blood_Type_Mother_id = Blood::all()->unique()->random()->id;
            $my_parents->Religion_Mother_id = Religion::all()->unique()->random()->id;
            $my_parents->Address_Mother = 'القاهرة';
            $my_parents->save();
        }
    }


}
