<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionStatus;
use Illuminate\Http\Request;

class SubscriptionStatusController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/subscriptionStatuses",
     *     summary="Get all Subscription statuses",
     *     tags={"Subscription Statuses"},
     *     security={{ "jwt_auth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="List of Subscription Statuses retrieved successfully",
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

        $subscriptionStatuses = SubscriptionStatus::all();

        return $subscriptionStatuses->isNotEmpty()
            ? $this->sendResponse($subscriptionStatuses,'List of Subscription Status')
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
