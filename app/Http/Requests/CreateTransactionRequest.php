<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'transaction_type_id' => 'required|exists:transaction_types,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'transaction_ref' => 'required|string',
            'status' => 'required|boolean',
            'currency' => 'required|string',
            'amount' => 'required|numeric|min:0',
//            'created_by_user_id' => 'required|exists:users,id',
        ];
    }
}
