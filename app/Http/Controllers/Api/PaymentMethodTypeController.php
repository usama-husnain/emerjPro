<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethodType;
use Illuminate\Http\Request;

class PaymentMethodTypeController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/paymentMethodTypes",
     *     summary="Get all payment method types",
     *     tags={"Payment Method Types"},
     *     security={{ "jwt_auth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="List of Payment Method type retrieved successfully",
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

        $paymentMehtodTypes = PaymentMethodType::all();

        return $paymentMehtodTypes->isNotEmpty()
            ? $this->sendResponse($paymentMehtodTypes,'List of Payment Method Type')
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
