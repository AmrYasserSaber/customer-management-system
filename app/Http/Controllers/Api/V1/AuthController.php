<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user();
            if($credentials['email']== env('Admin_Email') && $credentials['password'] == env('Admin_Password')){
                $token = $user->createToken('Admin Token')->plainTextToken;
            }else{
                $token = $user->createToken('API Token',['delete:customer','create:customer','update:customer','create:invoice','delete:invoice','update:invoice'])->plainTextToken;
            }
            return response()->json([
                'token' => $token,
                'user' => $user
            ]);
        } else {
            // Authentication failed
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
    }
}

