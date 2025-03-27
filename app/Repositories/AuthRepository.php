<?php

namespace App\Repositories;

use App\Enums\RoleEnum;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Repositories\PatientRepository;
use App\SaveFilesHelperClass;
use Illuminate\Support\Facades\Date;
use Spatie\Permission\Models\Role;

class AuthRepository implements AuthRepositoryInterface
{

    protected $patientRepo;

    public function __construct(PatientRepository $patientRepo)
    {
        $this->patientRepo = $patientRepo;
    }

    public function register(array $data)
    {

        $user = User::create([
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'city' => $data['city'],
            'hood' => $data['hood'],
            'role_id' => $data['role_id']
        ]);


        $role = Role::find($data['role_id'])->name;

        if ($role === RoleEnum::PATIENT->value) {
            $this->patientRepo->store($data, $user->id, false);
        }
        elseif($role === RoleEnum::FAMILY->value) {
            $this->patientRepo->store($data, $user->id, true);
        }

        $token = $user->createToken('API Token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user->load('role'),
        ];
    }

    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->last_login == null) {
                $user->update(['last_login' => now()]);
            }else{
                $user->update(['is_first_login' => false]);
            }

            $token = $user->createToken('API Token')->plainTextToken;

            return [
                'success' => true,
                'token' => $token,
                'user' => $user->load('role'),
            ];
        }

        return [
            'success' => false,
            'message' => 'Invalid phone or password.',
        ];
    }

    public function updateProfile($request)
    {
        $user = auth()->user();
        $fields = ['phone', 'avatar', 'city', 'hood', 'gender', 'birthday'];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $user->{$field} = $request->get($field);
            }
        }

        if ($request->has('avatar') && $request->get('avatar') != null) {
            $avatar= $request->input('avatar');
            $filePath = SaveFilesHelperClass::saveUploadedFile($avatar,'avatars');
            $user->avatar = $filePath;
        }

        $user->save();

        return $user;
    }
}
