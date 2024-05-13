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

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User registration data",
     *         @OA\JsonContent(
     *             required={"username", "email", "password", "first_name", "last_name", "dob", "ibi_id", "ibi_name", "phone_number", "address_line1", "city", "state", "country", "region", "subscription_type_id", "currency", "price", "start_date", "role_id"},
     *             @OA\Property(property="username", type="string", maxLength=255, description="Username"),
     *             @OA\Property(property="email", type="string", format="email", maxLength=255, description="User email"),
     *             @OA\Property(property="password", type="string", format="password", minLength=8, description="User password"),
     *             @OA\Property(property="first_name", type="string", maxLength=255, description="First name"),
     *             @OA\Property(property="last_name", type="string", maxLength=255, description="Last name"),
     *             @OA\Property(property="dob", type="string", format="date", description="Date of birth (YYYY-MM-DD)"),
     *             @OA\Property(property="ibi_id", type="string", maxLength=255, description="IBI ID"),
     *             @OA\Property(property="ibi_name", type="string", maxLength=255, description="IBI name"),
     *             @OA\Property(property="phone_number", type="string", maxLength=255, description="Phone number"),
     *             @OA\Property(property="notes", type="string", description="Notes"),
     *             @OA\Property(property="register_at", type="string", format="date", description="Registration date (YYYY-MM-DD)"),
     *             @OA\Property(property="profile", type="string", format="binary", description="Profile image"),
     *             @OA\Property(property="address_line1", type="string", description="Address line 1"),
     *             @OA\Property(property="address_line2", type="string", description="Address line 2"),
     *             @OA\Property(property="city", type="string", description="City"),
     *             @OA\Property(property="state", type="string", description="State"),
     *             @OA\Property(property="country", type="string", description="Country"),
     *             @OA\Property(property="region", type="string", description="Region"),
     *             @OA\Property(property="subscription_type_id", type="integer", description="Subscription type ID"),
     *             @OA\Property(property="currency", type="string", description="Currency"),
     *             @OA\Property(property="price", type="number", format="double", description="Price"),
     *             @OA\Property(property="start_date", type="string", format="date", description="Start date (YYYY-MM-DD)"),
     *             @OA\Property(property="role_id", type="integer", description="Role ID"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="User registered successfully."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="user", type="object"),
     *                 @OA\Property(property="token", type="string", description="Bearer token")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation Failed"),
     *             @OA\Property(property="errors", type="object", example={"email": {"The email field is required."}})
     *         )
     *     )
     * )
     */
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



    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="User login",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User login data",
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", description="User email"),
     *             @OA\Property(property="password", type="string", format="password", description="User password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Login successful"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="user", type="object"),
     *                 @OA\Property(property="token", type="string", description="Bearer token")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Login failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation Failed"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
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


    /**
     * @OA\Post(
     *     path="/api/refresh",
     *     summary="User Regresh Token",
     *     tags={"Authentication"},
     *     security={{ "jwt_auth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="New Token Generated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid request",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Could not refresh token")
     *         )
     *     )
     * )
     */
    public function refresh()
    {
        try {

            $token = JWTAuth::parseToken()->refresh();

        } catch (JWTException $e) {

            return response()->json(['error' => 'Could not refresh token'], 401);
        }

        return response()->json(['token' => $token]);
    }

}
