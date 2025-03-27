<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {


        $this->call(RoleSeeder::class);
        $this->call(SpecialtySeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(PatientSeeder::class);

    }
}
