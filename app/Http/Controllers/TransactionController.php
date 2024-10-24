<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('category')->get();

        return response()->json([
            'transactions' => $transactions
        ]);
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = new Transaction();
        $transaction->description = $request->description;
        $transaction->amount = $request->amount;
        $transaction->category = $request->category;
        $transaction->type = $request->type;
        $transaction->save();

        return response()->json([
            'transaction' => $transaction
        ]);
    }

    public function show(String $id) {
        $transaction = Transaction::where('id', $id)->first();

        if (!$transaction) {
            return response()->json([
                'error' => 'Transaction not found'
            ], 404);
        }

        return response()->json([
            'transaction' => $transaction
        ]);
    }

    public function destroy(String $id) {
        $transaction = Transaction::where('id', $id)->first();

        if (!$transaction) {
            return response()->json([
                'error' => 'Transaction not found'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'message' => 'Transaction has been deleted'
        ]);
    }
}
