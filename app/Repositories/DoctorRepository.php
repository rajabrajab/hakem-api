<?php

namespace App\Repositories;

use App\Interfaces\DoctorRepositoryInterface;
use App\Models\Doctor;

class DoctorRepository implements DoctorRepositoryInterface
{

    public function index()
    {
        $doctors =  Doctor::with(['user','specialty'])->get();

        return $doctors;
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
