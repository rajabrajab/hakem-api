<?php

namespace App\Repository\FamilyMembers;

use App\Interfaces\FamilyMemberRepositoryInterface;
use App\Models\FamilyMember;
use App\Models\Patient;
use Illuminate\Http\Request;

class FamilyMembersRepository implements FamilyMemberRepositoryInterface
{
    public function store($data ,$familyOwner)
    {
        return collect($data->members)->map(function ($member) use ($familyOwner) {

        $patient = Patient::create([
            'family_owner_id' => $familyOwner->id,
            'full_name' => $member['full_name'],
            'gender' => $member['gender'],
            'birthday' => $member['birthday']
        ]);


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

        $patient->update([
            'full_name' => $data->input('full_name', $patient->full_name),
            'gender' => $data->input('gender', $patient->gender),
            'birthday' => $data->input('birthday', $patient->birthday),
            'weight' => $data->input('weight', $patient->weight),
            'height' => $data->input('height', $patient->height),
        ]);


        $familyMember->update([
            'relationship' =>   $data->input('relationship', $familyMember->relationship),
        ]);


        return $familyMember->load('patient');
    }

    public function delete($id)
    {

    }
}
