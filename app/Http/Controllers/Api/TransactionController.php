<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/transactions",
     *     summary="Get all transactions",
     *     tags={"Transactions"},
     *     security={{ "jwt_auth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="List of transactions retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(type="object")
     *             ),
     *         )
     *     )
     * )
     */
    public function index()
    {
        $transactions = Transaction::with(['user','createdByUser','transactionType','paymentMethod'])->get();

        return $transactions->isNotEmpty()
            ? $this->sendResponse($transactions,'List of Transactions')
            : $this->sendResponse([],'Record not found');

    }


    /**
     * @OA\Post(
     *     path="/api/transactions",
     *     summary="Create a new transaction",
     *     tags={"Transactions"},
     *     security={{ "jwt_auth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Transaction data",
     *         @OA\JsonContent(
     *             required={"user_id", "transaction_type_id", "payment_method_id", "transaction_ref", "status", "currency", "amount"},
     *             @OA\Property(property="user_id", type="integer", description="User ID"),
     *             @OA\Property(property="transaction_type_id", type="integer", description="Transaction Type ID"),
     *             @OA\Property(property="payment_method_id", type="integer", description="Payment Method ID"),
     *             @OA\Property(property="transaction_ref", type="string", description="Transaction reference"),
     *             @OA\Property(property="status", type="boolean", description="Transaction status"),
     *             @OA\Property(property="currency", type="string", description="Transaction currency"),
     *             @OA\Property(property="amount", type="number", description="Transaction amount"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transaction created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Transaction created successfully."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="transaction", type="object"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation Failed"),
     *             @OA\Property(property="errors", type="object", example={"user_id": {"The user_id field is required."}})
     *         )
     *     )
     * )
     */
    public function store(CreateTransactionRequest $request)
    {

        $request['created_by_user_id'] = Auth::id();
        try {
            $transaction = Transaction::create($request->all());
            $transaction = Transaction::with(['user','createdByUser','transactionType','paymentMethod'])->find($transaction->id);
            return $this->sendResponse($transaction, 'New Transaction created.');
        } catch (\Exception $exception)
        {
            return $this->sendError('An error occurred while new transaction.', $exception->getMessage(), 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction = Transaction::with(['user','createdByUser','transactionType','paymentMethod'])->find($transaction->id);
        try {
            return $this->sendResponse($transaction, 'Transaction found.');
        } catch (\Exception $exception)
        {
            return $this->sendError('An error occurred', $exception->getMessage(), 500);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
//        try {
//            $transaction_update = $transaction->update($request->all());
//            return $this->sendResponse($transaction, 'Transaction updated');
//        } catch (\Exception $exception)
//        {
//            return $this->sendError('An error occurred while updating transaction.', $exception->getMessage(), 500);
//
//        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        try {
            $transaction->delete();
            return $this->sendResponse([], 'Transaction deleted');
        } catch (\Exception $exception)
        {
            return $this->sendError('An error occurred while deleting transaction.', $exception->getMessage(), 500);

        }
    }
}
