<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        $token = $user->createToken('auth-token' . $user->name)->plainTextToken;

        $user->assignRole('teacher');
        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();

        if(! Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            return response()->json(['message' => 'invali credentials'], 403);
        }

        $user = User::where('email', $data['email'])->first();
        $token = $user->createToken('auth-token' . $user->name)->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }
}