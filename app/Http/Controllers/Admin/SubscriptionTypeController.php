<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;

class SubscriptionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptionTypes = SubscriptionType::all();
        return view('admin.subscriptionTypes.index', compact('subscriptionTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subscriptionTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subscriptionTypes = SubscriptionType::create($request->all());
        return redirect()->route('admin.subscriptionTypes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionType $subscriptionType)
    {
        return view('admin.subscriptionTypes.show', compact('subscriptionType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscriptionType $subscriptionType)
    {
        return view('admin.subscriptionTypes.edit', compact('subscriptionType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscriptionType $subscriptionType)
    {
        $subscriptionType->update($request->all());
        return redirect()->route('admin.subscriptionTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionType $subscriptionType)
    {
        $subscriptionType->delete();

        return back();
    }
}
