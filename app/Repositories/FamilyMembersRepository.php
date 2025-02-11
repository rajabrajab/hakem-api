<?php

namespace App\Repositories;

use App\Interfaces\FamilyMemberRepositoryInterface;
use App\Models\FamilyMember;
use App\Repositories\PatientRepository;

class FamilyMembersRepository implements FamilyMemberRepositoryInterface
{
    protected $patientRepo;

    public function __construct(PatientRepository $patientRepo)
    {
        $this->patientRepo = $patientRepo;
    }

    public function store($data ,$familyOwner)
    {
        return collect($data->members)->map(function ($member) use ($familyOwner) {

        $patient = $this->patientRepo->store($member, $familyOwner->id, true);


        return FamilyMember::create([
            'family_owner_id' => $familyOwner->id,
            'patient_id' => $patient->id,
            'relationship' => $member['relationship'],
            ]);
        });
    }

    public function update($id,$data)
    {
        $familyMember = FamilyMember::findOrFail($id);

        $patient = $familyMember->patient;


        $this->patientRepo->update($patient, $data->all());


        $familyMember->update([
            'relationship' =>   $data->input('relationship', $familyMember->relationship),
        ]);


        return $familyMember->load('patient');
    }

    public function delete($id)
    {

    }
}
