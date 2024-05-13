<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get all Users",
     *     tags={"Users"},
     *     security={{ "jwt_auth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="List of Users retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(type="object")
     *             ),
     *         )
     *     )
     * )
     */
    public function index()
    {

        $users = User::with(['address', 'subscription', 'roles'])->get();

        return $users->isNotEmpty()
            ? $this->sendResponse($users,'List of users')
            : $this->sendResponse([],'Record not found');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
//        $user = User::find($user);
        $user['address'] = $user->address;
        $user['subscription'] = $user->subscription;
        try {
            return $this->sendResponse($user, 'User found.');
        } catch (\Exception $exception)
        {
            return $this->sendError('An error occurred', $exception->getMessage(), 500);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->address()->delete();
            $user->subscription()->delete();
            $user->delete();
            return $this->sendResponse([], 'User deleted');
        } catch (\Exception $exception)
        {
            return $this->sendError('An error occurred while deleting user.', $exception->getMessage(), 500);

        }
    }
}
