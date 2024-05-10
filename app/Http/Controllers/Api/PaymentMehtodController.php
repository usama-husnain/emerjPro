<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentMehtodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::with(['paymentMethodType'])->get();

        return $paymentMethods->isNotEmpty()
            ? $this->sendResponse($paymentMethods,'List of Payment Methods')
            : $this->sendResponse([],'Record not found');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
