<?php

namespace App\Repositories;

use App\Helpers\FilterHelper;
use App\Interfaces\DoctorRepositoryInterface;
use App\Models\Doctor;

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
        $doctor = Doctor::create($data);
        return $doctor;
    }

    public function update($id, array $data)
    {

        $room = Doctor::findOrFail($id);

        $room->update($data);

        return $room;
    }

    public function delete($id)
    {

        $room = Doctor::findOrFail($id);

        $room->delete();

        return true;
    }

}
