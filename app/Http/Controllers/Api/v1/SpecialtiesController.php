<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\SpecialtyRepository;
use Illuminate\Http\Request;

class SpecialtiesController extends Controller
{
    protected $specialtyRepository;

    public function __construct(SpecialtyRepository $specialtyRepository)
    {
        $this->specialtyRepository = $specialtyRepository;
    }


    public function index()
    {
        $specialties = $this->specialtyRepository->index();
        return response()->data($specialties);
    }

    public function store(Request $request)
    {
        $data = $request->validate([

        ]);

        $specialty = $this->specialtyRepository->store($data);

        return response()->data($specialty,'Specialty added successfully.');
    }

     public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'full_name' => 'nullable|string',
            'gender' => 'nullable|string',
            'birthday' => 'nullable|date',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
        ]);

        $specialty = $this->specialtyRepository->update($data, $id);

        return response()->data($specialty,'Specialty updated successfully.');
    }

    public function destroy($id)
    {
        $this->specialtyRepository->delete($id);

        return response()->success('Specialty deleted successfully.');
    }
}
