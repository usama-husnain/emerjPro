<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionStatus;
use Illuminate\Http\Request;

class SubscriptionStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptionStatuses = SubscriptionStatus::all();
        return view('admin.subscriptionStatuses.index', compact('subscriptionStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subscriptionStatuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subscriptionStatus = SubscriptionStatus::create($request->all());
        return redirect()->route('admin.subscriptionStatuses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionStatus $subscriptionStatus)
    {
        return view('admin.subscriptionStatuses.show', compact('subscriptionStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscriptionStatus $subscriptionStatus)
    {
        return view('admin.subscriptionStatuses.edit', compact('subscriptionStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscriptionStatus $subscriptionStatus)
    {
        $subscriptionStatus->update($request->all());
        return redirect()->route('admin.subscriptionStatuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionStatus $subscriptionStatus)
    {
        $subscriptionStatus->delete();

        return back();
    }
}
