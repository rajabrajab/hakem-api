<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{

    public function run()
    {

        $specialties = Specialty::all();

        for ($i = 1; $i <= 10; $i++) {

            $user = User::create([
                'phone' => '123456789' . $i,
                'password' => Hash::make('password'),
                'city' => 'City ' . $i,
                'hood' => 'Neighborhood ' . $i,
                'role_id' => 4,
            ]);

            Doctor::create([
                'full_name' => 'دكتور' . $i,
                'user_id' => $user->id,
                'specialty_id' => $specialties->random()->id,
                'gender' => $i % 2 === 0 ? 'Male' : 'Female',
            ]);
        }
    }
}
