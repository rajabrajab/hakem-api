<?php

namespace App\Repositories;

use App\Interfaces\SpecialtyRepositoryInterface;
use App\Models\Specialty;

class SpecialtyRepository implements SpecialtyRepositoryInterface
{

    public function index()
    {
        $speciltes =  Specialty::all();

        return $speciltes;
    }


    public function store(array $data)
    {
        $specialty = Specialty::create($data);
        return $specialty;
    }

    public function update($id, array $data)
    {

        $specialty = Specialty::findOrFail($id);

        $specialty->update($data);

        return $specialty;
    }

    public function delete($id)
    {

        $specialty = Specialty::findOrFail($id);

        $specialty->delete();

        return true;
    }

}
