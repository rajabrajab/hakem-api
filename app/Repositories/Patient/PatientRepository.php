<?php

namespace App\Repositories\Patient;


use App\Interfaces\PatientRepositoryInterface;
use App\Models\Patient;


class PatientRepository implements PatientRepositoryInterface
{
    public function store($data,$ownerId, $isFamilyMember = false)
    {
        return Patient::create([
                'full_name' => $data['full_name'],
                'gender' => $data['gender'],
                'birthday' => $data['birthday'] ?? null,
                'weight' => $data['weight'] ?? null,
                'height' => $data['height'] ?? null,
                'family_owner_id' => $isFamilyMember ? $ownerId : null,
                'user_id' => !$isFamilyMember ? $ownerId : null,
        ]);
    }

    public function update(Patient $patient, array $data)
    {
        $patient->update([
            'full_name' => $data['full_name'] ?? $patient->full_name,
            'gender' => $data['gender'] ?? $patient->gender,
            'birthday' => $data['birthday'] ?? $patient->birthday,
            'weight' => $data['weight'] ?? $patient->weight,
            'height' => $data['height'] ?? $patient->height,
        ]);

        return $patient;
    }
}
