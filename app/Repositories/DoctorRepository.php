<?php

namespace App\Repositories;

use App\Helpers\FilterHelper;
use App\Interfaces\DoctorRepositoryInterface;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Arr;

class DoctorRepository implements DoctorRepositoryInterface
{

    public function index($request)
    {

        $filters = [
            'full_name' => $request->full_name,
            'city' => $request->city,
            'hood' => $request->hood,
            'specialty_id' => $request->specialty_id
        ];

        $relations = [
            'full_name' => 'user',
            'hood' => 'user',
            'city' => 'user'
        ];

        $query =  Doctor::with('user');

        if($request->limit){
            $doctors = FilterHelper::applyFilters($query, $filters,$relations)->take($request->limit)->get();
        }else{
            $doctors = FilterHelper::applyFilters($query, $filters,$relations)->get();
        }


        $groupedDoctors = $doctors->groupBy(fn($doctor) => $doctor->specialty->name);

        $formatedDoctors = $groupedDoctors->map(function($doctors, $speciltyName){
            return [
                'name' => $speciltyName,
                'data' => $doctors->values()
            ];
        })->values();

        return $formatedDoctors;
    }

    public function show($id)
    {
        $doctor =  Doctor::findOrFail($id);
        $doctor->load(['user','specialty']);
        return $doctor;
    }

    public function store(array $data)
    {

        $user = User::create([
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'role_id' => 4
        ]);

        $doctorData = array_merge($data, ['user_id' => $user->id]);

        $doctor = Doctor::create($doctorData);

        return $doctor;
    }

    public function update($id,$doctorData,$userData = null)
    {

        $doctor = Doctor::findOrFail($id);

        if (!empty($userData)) {
            $doctor->user()->update($userData);
        }

        $doctor->update(Arr::except($doctorData, ['holidays']));

        if (isset($doctorData['holidays']) && is_array($doctorData['holidays'])) {
            $doctor->holidays()->delete();

            $holidaysData = array_map(fn($day) => ['day' => $day], $doctorData['holidays']);

            $doctor->holidays()->createMany($holidaysData);
        }


        return $doctor;
    }

    public function delete($id)
    {

        $room = Doctor::findOrFail($id);

        $room->delete();

        return true;
    }

}
