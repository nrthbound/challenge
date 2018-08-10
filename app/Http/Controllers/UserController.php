<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function login(UserLoginRequest $request)
    {
        if (!Auth::attempt($request->all())) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();
        $userToken = $user->createToken('Access Token');
        $token = $userToken->token;

        if ($token->save()) {
            return response()->json([
                'access_token' => $userToken->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $userToken->token->expires_at
                )->toDateTimeString()
            ]);
        }
    }
}
