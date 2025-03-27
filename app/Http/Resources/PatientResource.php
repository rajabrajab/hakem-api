<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'weight' => $this->weight,
            'height' => $this->height,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'blood_type' => $this->blood_type,
            'doctor_id' => $this->doctor_id,
            'has_account' => $this->user_id !== null,
        ];
    }
}
