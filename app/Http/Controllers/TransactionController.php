<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        return response()->json([
            'transactions' => $transactions
        ]);
    }

    public function store(Request $request)
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
}
