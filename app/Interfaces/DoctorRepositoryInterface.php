<?php

namespace App\Interfaces;

interface DoctorRepositoryInterface{

    public function index(array $data);

    public function store(array $data);

    public function update(int $id ,array $doctorData, array $userData);

    public function delete(int $id);
};
