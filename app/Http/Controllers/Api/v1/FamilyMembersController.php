<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\FamilyMembers\FamilyMembersRepository;
use Illuminate\Http\Request;

class FamilyMembersController extends Controller
{
    private $familyMembers;
    private $familyOwner;

    public function __construct(FamilyMembersRepository $familyMembers)
    {
        $this->familyMembers = $familyMembers;
        $this->familyOwner = Auth()->user();
    }


    public function store(Request $request)
    {
        $request->validate([
            'members' => 'required|array',
            'members.*.full_name' => 'required|string|max:255',
            'members.*.gender' => 'required|in:Male,Female',
            'members.*.relationship' => 'required|string|max:255',
            'members.*.birthday' => 'required|date|before:today',
        ]);

        $createdMembers = $this->familyMembers->store($request, $this->familyOwner);

        return response()->data($createdMembers, 'Family Members added successfully.');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'gender' => 'sometimes|in:Male,Female',
            'relationship' => 'sometimes|string|max:255',
            'birthday' => 'sometimes|date|before:today',
            'height' => 'sometimes|numeric',
            'weight' => 'sometimes|numeric'
        ]);

        $familyMember =  $this->familyMembers->update($id,$request);


        return response()->data($familyMember,'Family Members added successfully.');

    }

    public function destroy($id)
    {

    }


}
