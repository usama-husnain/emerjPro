<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'subscription_type_id',
        'currency',
        'price',
        'start_date',
        'next_billing_date',
        'subscription_status_id',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subscriptionType(){
        return $this->belongsTo(SubscriptionType::class);
    }

    public function subscriptionStatus(){
        return $this->belongsTo(SubscriptionStatus::class);
    }
}
