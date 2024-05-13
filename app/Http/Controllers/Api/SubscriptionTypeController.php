<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;

class SubscriptionTypeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/subscriptionTypes",
     *     summary="Get all Subscription types",
     *     tags={"Subscription Types"},
     *     security={{ "jwt_auth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="List of Subscription Types retrieved successfully",
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

        $subscriptionTypes = SubscriptionType::all();

        return $subscriptionTypes->isNotEmpty()
            ? $this->sendResponse($subscriptionTypes,'List of Subscription Types')
            : $this->sendResponse([],'Record not found');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
