<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodType;
use Illuminate\Http\Request;

class PaymentMethodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentMethodTypes = PaymentMethodType::all();
        return view('admin.paymentmethodtypes.index', compact('paymentMethodTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.paymentmethodtypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $paymentMethodType = PaymentMethodType::create($request->all());
        return redirect()->route('admin.paymentMethodTypes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethodType $paymentMethodType)
    {
        return view('admin.paymentmethodtypes.show', compact('paymentMethodType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethodType $paymentMethodType)
    {
        return view('admin.paymentmethodtypes.edit', compact('paymentMethodType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMethodType $paymentMethodType)
    {
        $paymentMethodType->update($request->all());
        return redirect()->route('admin.paymentMethodTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethodType $paymentMethodType)
    {
        $paymentMethodType->delete();

        return back();
    }
}
