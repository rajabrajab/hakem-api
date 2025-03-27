<?php

namespace Database\Seeders;


use App\Models\Patient;
use Illuminate\Database\Seeder;


class PatientSeeder extends Seeder
{

    public function run()
    {
        $patients = [
            [
                'full_name' => 'Ali Hassan',
                'doctor_id' => 1,
                'weight' => 70.5,
                'height' => 175,
                'birthday' => '1990-05-15',
                'gender' => 'Male',
                'blood_type' => 'O+',
            ],
            [
                'full_name' => 'Sara Ahmed',
                'doctor_id' => 1,
                'weight' => 60.2,
                'height' => 162,
                'birthday' => '1995-08-22',
                'gender' => 'Female',
                'blood_type' => 'A-',
            ],
            [
                'full_name' => 'Mohammed Khalid',
                'doctor_id' => 1,
                'weight' => 80.0,
                'height' => 180,
                'birthday' => '1987-11-10',
                'gender' => 'Male',
                'blood_type' => 'B+',
            ],
            [
                'full_name' => 'Lina Youssef',
                'doctor_id' => 1,
                'weight' => 55.4,
                'height' => 168,
                'birthday' => '2000-03-05',
                'gender' => 'Female',
                'blood_type' => 'AB+',
            ],
            [
                'full_name' => 'Omar Saleh',
                'doctor_id' => 1,
                'weight' => 90.7,
                'height' => 178,
                'birthday' => '1985-07-30',
                'gender' => 'Male',
                'blood_type' => 'O-',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}
