<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login User
     *
     * @param  LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Invalid email/password'], 401);
        }

        $user = User::where(['email' => $request->validated()['email']])->first();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => 'Login successful',
            [
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }
}
