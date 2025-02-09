<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Repositories\Patient\PatientRepository;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $patientRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }


    public function index()
    {
        $patients = $this->patientRepository->index();
        return response()->data($patients);
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

        $patient = $this->patientRepository->store($data);

        return response()->data($patient,'Patient added successfully.');
    }

     public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'full_name' => 'nullable|string',
            'gender' => 'nullable|string',
            'birthday' => 'nullable|date',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
        ]);

        $patient = $this->patientRepository->update($patient, $data);

        return response()->data($patient,'Patient updated successfully.');
    }

    public function destroy($id)
    {
        $this->patientRepository->delete($id);

        return response()->success('Patient deleted successfully.');
    }
}
