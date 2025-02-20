<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\DoctorRepository;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    protected $doctorRepository;

    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }


    public function index(Request $request)
    {
        $doctors = $this->doctorRepository->index($request);

        if($request->specialty_id)
        {
            return response()->data(...$doctors);
        }else{
            return response()->data($doctors);
        }
    }

    public function show(Request $request, $id)
    {
        $doctor = $this->doctorRepository->show($id);

        return response()->data($doctor);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string',
            'gender' => 'required|string',
            'birthday' => 'nullable|date',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
        ]);

        $doctor = $this->doctorRepository->store($data);

        return response()->data($doctor,'Doctor added successfully.');
    }

     public function update(Request $request,int $id)
    {
        $data = $request->validate([
            'full_name' => 'nullable|string',
            'gender' => 'nullable|string',
            'birthday' => 'nullable|date',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
        ]);

        $doctor = $this->doctorRepository->update($doctor, $data);

        return response()->data($doctor,'Doctor updated successfully.');
    }

    public function destroy($id)
    {
        $this->doctorRepository->delete($id);

        return response()->success('doctor deleted successfully.');
    }
}
