<?php

namespace App\Http\Controllers\Api;

use App\Helpers\UserRegisterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{

    public function register(CreateUserRequest $request)
    {
        $request['register_ip'] = $request->ip();
        $request['register_device'] = $request->userAgent();
        $request['password'] = bcrypt($request->password);
        $user = UserRegisterHelper::register($request);
        $user['role'] = $user->roles()->first();
        $user['address'] = $user->address;
        $user['subscription'] = $user->subscription;
        $token = JWTAuth::fromUser($user);
        $result = ['user' => $user, 'token' => $token];
        return $this->sendResponse($result, 'New user registered');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = Auth::user();
        $user->last_ip = $request->ip();
        $user->last_login = Carbon::now();
        $user->save();

        $data = ['user' => $user, 'token' => $token];
        return $this->sendResponse($data, 'User login successfully.');
    }

    public function refresh()
    {
        return response()->json([
            'token' => JWTAuth::parseToken()->refresh(),
        ]);
    }

}
