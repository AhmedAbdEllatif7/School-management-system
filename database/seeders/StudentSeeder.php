<?php

namespace Database\Seeders;

use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Nationality;
use App\Models\Parentt;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::table('students')->delete();

        $genders = Gender::all();

        $names = [
            ['ar' => 'احمد ابراهيم', 'en' => 'Ahmed Ibrahim'],
            ['ar' => 'علي محسن', 'en' => 'Ali Mohsen'],
            ['ar' => 'ليلي عبد الله', 'en' => 'Laila Abdallah'],
            ['ar' => 'إيهاب احمد', 'en' => 'Ehab Ahmed'],
            ['ar' => 'شيماء رجب', 'en' => 'Shimaa Ragab'],
            ['ar' => 'أمنة شلقامي', 'en' => 'Amna Shelqamy'],
            ['ar' => 'مصطفي جمال', 'en' => 'Moustafa Gamal'],
            ['ar' => 'عادل حسين', 'en' => 'Adel Husien'],
            ['ar' => 'وحيد سيد', 'en' => 'Waheed Sayed'],
        ];

        foreach ($names as $name) {
            $students = new Student();
            $students->name = $name;
            $students->email = $name['en'] . '@yahoo.com';
            $students->password = Hash::make('12345678');
            $students->gender_id = $genders->random()->id;
            $students->nationalitie_id = Nationality::all()->unique()->random()->id;
            $students->blood_id = Blood::all()->unique()->random()->id;
            $students->date_birth = date('1995-01-01');
            $students->grade_id = Grade::all()->unique()->random()->id;
            $students->classroom_id = Classroom::all()->unique()->random()->id;
            $students->section_id = Section::all()->unique()->random()->id;
            $students->parent_id = Parentt::all()->unique()->random()->id;
            $students->academic_year = '2021';
            $students->save();
        }
    }
    }
