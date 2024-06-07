<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\LeadException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            throw new LeadException(
                "Password incorrect for: {$request->username}",
                Response::HTTP_UNAUTHORIZED
            );
        }

        return response()->json([
            'meta' => ['success' => true, 'errors' => []],
            'data' => [
                'token' => $token,
                'minutes_to_expire' => config('jwt.ttl')
            ]
        ], 200);
    }
}
