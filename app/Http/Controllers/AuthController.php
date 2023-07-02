<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;

class AuthController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();
        if(isset($data['avatar'])){
            $data['avatar'] = $this->userRepository->saveImage($data['avatar']);
        }
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
            return response()->json(['message' => 'invalid credentials'], 403);
        }

        $user = User::where('email', $data['email'])->first();
        $token = $user->createToken('auth-token' . $user->name)->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => "logged out!"]);
    }
}
