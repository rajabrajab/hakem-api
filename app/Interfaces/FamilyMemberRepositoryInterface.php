<?php

namespace App\Interfaces;


interface FamilyMemberRepositoryInterface{
    public function store(array $data , $familyOwner);

    public function update(int $id,array $data);

    public function delete(int $id);
};
