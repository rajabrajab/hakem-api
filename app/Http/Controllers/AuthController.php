<?php

namespace App\Http\Controllers;

use App\Repository\Auth\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|unique:users',
            'city' => 'required|string',
            'hood' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'birthday' => 'required|date|before:today',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $response = $this->authRepository->register($data);

        return response()->data([
            'token'   => $response['token'],
            'user'    => $response['user']
        ], 'User registered successfully.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required|string|regex:/^\+?[0-9]{8,15}$/',
            'password' => 'required|string|min:8',
        ]);

        $response = $this->authRepository->login($credentials);

        if (!$response['success']) {
           return response()->error(401, $response['message']);
        }

        return response()->data([
                    'token' => $response['token'],
                    'user' => $response['user'],
                ], 'Login successful.');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|regex:/^\+?[0-9]{8,15}$/',
            'avatar' => 'sometimes|string',
            'city' => 'sometimes|string',
            'hood' => 'sometimes|string',
            'gender' => 'sometimes|in:Male,Female',
            'birthday' => 'sometimes|date|before:today'
        ]);

        $user = $this->authRepository->updateProfile($request);

        return response()->json($user, 200);
    }
}
