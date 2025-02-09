<?php

namespace App\Interfaces;

interface DoctorRepositoryInterface{

    public function index();

    public function store(array $data);

    public function update(int $id ,array $data);

    public function delete(int $id);
};
