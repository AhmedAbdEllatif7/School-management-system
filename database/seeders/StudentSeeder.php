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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{public function run(): void
    {

        // DB::table('students')->delete();

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
            $student = new Student();
            $student->name = $name;
            $student->email = strtolower(str_replace(' ', '_', $name['en'])) . '@gmail.com';
            $student->password = Hash::make('12345678');
            $student->gender_id = $genders->random()->id;
            $student->nationalitie_id = Nationality::all()->random()->id;
            $student->blood_id = Blood::all()->random()->id;
            $student->date_birth = '1995-01-01'; // Modify this to your desired date format
            $student->grade_id = Grade::all()->random()->id;
            $student->classroom_id = Classroom::all()->random()->id;
            $student->section_id = Section::all()->random()->id;
            $student->parent_id = Parentt::all()->random()->id;
            $student->academic_year = '2021';
            $student->save();
        }
    }
    }
