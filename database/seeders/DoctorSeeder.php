<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use Carbon\Carbon;
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

            $startHour = rand(8, 12);
            $endHour = rand(13, 17);

            $clinicStartTime = Carbon::createFromTime($startHour, 0, 0);
            $clinicEndTime = Carbon::createFromTime($endHour, 0, 0);

            Doctor::create([
                'full_name' => 'دكتور' . $i,
                'clinic_location' => 'عيادات' . $i ,
                'clinic_start_time' => $clinicStartTime,
                'clinic_end_time' => $clinicEndTime,
                'user_id' => $user->id,
                'specialty_id' => $specialties->random()->id,
                'gender' => $i % 2 === 0 ? 'Male' : 'Female',
            ]);
        }
    }
}
