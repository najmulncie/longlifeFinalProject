<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Method to handle form submission
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'transaction_id' => 'required|string|unique:transactions',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'transaction_id' => $request->transaction_id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('message', 'Transaction submitted for verification.');
    }

    // Method to show user's transactions
    public function index()
    {
        $transactions = Auth::user()->transactions;
        return view('user.transaction.transactions', compact('transactions'));
    }
}
