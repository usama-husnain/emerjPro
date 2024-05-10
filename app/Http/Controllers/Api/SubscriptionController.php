<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Monolog\SignalHandler;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::with(['user','subscriptionType','subscriptionStatus'])->get();
        return $subscriptions->isNotEmpty()
            ? $this->sendResponse($subscriptions,'List of subscriptions')
            : $this->sendResponse([],'Record not found');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSubscriptionRequest $request)
    {
        if($request->subscription_type_id == 1)
        {
            $request['next_billing_date'] = Carbon::parse($request->start_date)->addMonth()->toDateString();
        }
        elseif ($request->subscription_type_id == 2)
        {
            $request['next_billing_date'] = Carbon::parse($request->start_date)->addYear()->toDateString();
        }

        $user = User::find($request->user_id);
        if ($user){
            $request['uuid'] = $user->uuid;
        }

        $request['subscription_status_id'] = 1;

        try {
            $sub = Subscription::create($request->all());
            $subscription = Subscription::with(['user','subscriptionType','subscriptionStatus'])->find($sub->id);
            return $this->sendResponse($subscription, 'New Subscription created.');
        } catch (\Exception $exception)
        {
            return $this->sendError('An error occurred while new subscription.', $exception->getMessage(), 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        $subscription = Subscription::with(['user','subscriptionType','subscriptionStatus'])->find($subscription);

        try {
            return $this->sendResponse($subscription, 'Subscription found.');
        } catch (\Exception $exception)
        {
            return $this->sendError('An error occurred', $exception->getMessage(), 500);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateSubscriptionRequest $request, Subscription $subscription)
    {
        if($request->subscription_type_id == 1)
        {
            $request['next_billing_date'] = Carbon::parse($request->start_date)->addMonth()->toDateString();
        }
        elseif ($request->subscription_type_id == 2)
        {
            $request['next_billing_date'] = Carbon::parse($request->start_date)->addYear()->toDateString();
        }

        $user = User::find($request->user_id);
        if ($user){
            $request['uuid'] = $user->uuid;
        }

        $request['subscription_status_id'] = 1;

        try {
            $subscription_update = $subscription->update($request->all());
            $subscription = Subscription::with(['user','subscriptionType','subscriptionStatus'])->find($subscription);
            return $this->sendResponse($subscription, 'Subscription updated.');
        } catch (\Exception $exception)
        {
            return $this->sendError('An error occurred while updating subscription.', $exception->getMessage(), 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        try {
            $subscription->delete();
            return $this->sendResponse([], 'Subscription deleted');
        } catch (\Exception $exception)
        {
            return $this->sendError('An error occurred while deleting subscription.', $exception->getMessage(), 500);

        }
    }
}
