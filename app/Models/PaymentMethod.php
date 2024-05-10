<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method_type_id',
        'name',
        'last_digits',
        'usage_count',
        'token',
    ];

    public function paymentMethodType(){
        return $this->belongsTo(PaymentMethodType::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
