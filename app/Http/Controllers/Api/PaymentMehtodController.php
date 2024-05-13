<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePyamentMethodRequest;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentMehtodController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/paymentMethods",
     *     summary="Get a list of payment methods",
     *     tags={"Payment Methods"},
     *     security={{ "jwt_auth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="List of payment methods",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(type="object",
     *                     @OA\Property(property="payment_method", type="object"),
     *                 ),
     *             ),
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::with(['paymentMethodType'])->get();

        return $paymentMethods->isNotEmpty()
            ? $this->sendResponse($paymentMethods,'List of Payment Methods')
            : $this->sendResponse([],'Record not found');
    }


    /**
     * @OA\Post(
     *     path="/api/paymentMethods",
     *     summary="Register a new payment method",
     *     tags={"Payment Methods"},
     *     security={{ "jwt_auth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Payment method data",
     *         @OA\JsonContent(
     *             required={"user_id", "payment_method_type_id", "name", "last_digits", "token"},
     *             @OA\Property(property="user_id", type="integer", description="User ID"),
     *             @OA\Property(property="payment_method_type_id", type="integer", description="Payment method type ID"),
     *             @OA\Property(property="name", type="string", description="Name of the payment method"),
     *             @OA\Property(property="last_digits", type="string", description="Last digits of the payment method"),
     *             @OA\Property(property="token", type="string", description="Payment token"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Payment method added successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Payment method added successfully."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="payment_method", type="object"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation Failed"),
     *             @OA\Property(property="errors", type="object"),
     *         )
     *     )
     * )
     */
    public function store(CreatePyamentMethodRequest $request)
    {
        $getPaymentMethod = PaymentMethod::where('user_id', $request->user_id)
                            ->where('payment_method_type_id', $request->payment_method_type_id)
                            ->where('last_digits', $request->last_digits)
                            ->first();


        if($getPaymentMethod)
        {
                $getPaymentMethod->usage_count += 1;
                $getPaymentMethod->save();
                return $this->sendResponse($getPaymentMethod, 'Payment Method added.');
        }
        $request['usage_count'] = 1;
        try {
            $paymentMethod = PaymentMethod::create($request->all());
            $paymentMethod = PaymentMethod::with(['paymentMethodType'])->find($paymentMethod->id);
            return $this->sendResponse($paymentMethod, 'New Payment Method created.');
        } catch (\Exception $exception)
        {
            return $this->sendError('An error occurred while new payment method creation.', $exception->getMessage(), 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        $paymentMethod = PaymentMethod::with(['paymentMethodType'])->find($paymentMethod);
        try {
            return $this->sendResponse($paymentMethod, 'Payment Method found.');
        } catch (\Exception $exception)
        {
            return $this->sendError('An error occurred', $exception->getMessage(), 500);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
//        try {
//            $paymentMethod_update = $paymentMethod->update($request->all());
//            $paymentMethod = PaymentMethod::with(['paymentMethodType'])->find($paymentMethod);
//            return $this->sendResponse($paymentMethod, 'Payment Method updated.');
//        } catch (\Exception $exception)
//        {
//            return $this->sendError('An error occurred while updating payment method.', $exception->getMessage(), 500);
//
//        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        try {
            $paymentMethod->delete();
            return $this->sendResponse([], 'Payment Method deleted');
        } catch (\Exception $exception)
        {
            return $this->sendError('An error occurred while deleting Payment Method.', $exception->getMessage(), 500);

        }
    }
}
