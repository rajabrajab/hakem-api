<?php

namespace App\Interfaces;

use App\Models\Patient;

interface PatientRepositoryInterface{

    public function store(array $data, int $ownerId, bool $isFamilyMember);

    public function update(Patient $patient ,array $data);
};
