<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_type_id',
        'payment_method_id',
        'transaction_ref',
        'status',
        'currency',
        'amount',
        'created_by_user_id',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function createdByUser(){
        return $this->belongsTo(User::class,'created_by_user_id');
    }

    public function transactionType(){
        return $this->belongsTo(TransactionType::class);
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }

}
