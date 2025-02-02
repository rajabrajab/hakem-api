<?php

namespace App\Repository\Auth;

use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\SaveFilesHelperClass;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data)
    {

        $user = User::create([
            'full_name' => $data['full_name'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'city' => $data['city'],
            'hood' => $data['hood'],
            'gender' => $data['gender'],
            'birthday' => $data['birthday'],
            'role_id' => $data['role_id']
        ]);

        $token = $user->createToken('API Token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return [
                'success' => true,
                'token' => $token,
                'user' => $user,
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
        $fields = ['full_name', 'phone', 'avatar', 'city', 'hood', 'gender', 'birthday'];

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
