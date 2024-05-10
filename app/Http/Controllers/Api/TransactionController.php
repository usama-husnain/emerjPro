<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['user','createdByUser','transactionType','paymentMethod'])->get();

        return $transactions->isNotEmpty()
            ? $this->sendResponse($transactions,'List of Transactions')
            : $this->sendResponse([],'Record not found');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
