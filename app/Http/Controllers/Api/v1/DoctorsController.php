<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\DoctorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string|min:6',
        ]);

        $doctor = $this->doctorRepository->store($data);

        return response()->data($doctor,'Doctor added successfully.');
    }

    public function update(Request $request,int $id)
    {
        $data = $request->validate([
            'bio' => 'nullable|string',
            'image_id' => 'nullable|exists:files,id',
            'specialty_id' => 'nullable|exists:specialties,id',
            'detailed_specialization' => 'nullable|string',
            'clinic_location' => 'nullable|string',
            'city' => 'nullable|string',
            'hood' => 'nullable|string',
        ]);

        $doctorData = Arr::except($data, ['image_id', 'city', 'hood']);
        $userData = Arr::only($data, ['image_id', 'city', 'hood']);

        $doctor = $this->doctorRepository->update($id, $doctorData,$userData);

        return response()->data($doctor,'Doctor updated successfully.');
    }

    public function updateClinicReservationInfo(Request $request,int $doctorId)
    {
        $data = $request->validate([
            'clinic_location' => 'nullable|string',
            'clinic_start_time' => 'nullable|date_format:H:i',
            'clinic_end_time' => 'nullable|date_format:H:i',
            'appointment_duration' => 'nullable|integer',
            'can_book_for' => 'nullable|integer',
            'holidays' => 'nullable|array',
            'holidays.*' => 'in:sun,mon,tue,wed,thu,fri,sat'
        ]);

        $doctor = $this->doctorRepository->update($doctorId,$data);

        return response()->data($doctor,'Doctor updated successfully.');
    }

    public function destroy($id)
    {
        $this->doctorRepository->delete($id);

        return response()->success('doctor deleted successfully.');
    }
}
