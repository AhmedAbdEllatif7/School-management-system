<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Blood;
use ClassroomTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        //Blood::factory(10)->create();
        
        $this->call(SettingsTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(BloodTableSeeder::class);
        $this->call(NationalityTableSeeder::class);
        $this->call(ReligionTableSeeder::class);
        $this->call(SpecializationTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(ParentSeeder::class);
    }

}