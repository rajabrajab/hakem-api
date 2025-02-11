<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{

    public function run()
    {
        $specialties = [
            ['name' => 'القلبية', 'name_en' => 'Cardiology'],
            ['name' => 'الجلدية', 'name_en' => 'Dermatology'],
            ['name' => 'العظمية', 'name_en' => 'Orthopedics'],
            ['name' => 'الأطفال', 'name_en' => 'Pediatrics'],
            ['name' => 'الأعصاب', 'name_en' => 'Neurology'],
            ['name' => 'الأورام', 'name_en' => 'Oncology'],
            ['name' => 'النسائية والتوليد', 'name_en' => 'Gynecology'],
            ['name' => 'المسالك البولية', 'name_en' => 'Urology'],
            ['name' => 'العيون', 'name_en' => 'Ophthalmology'],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
