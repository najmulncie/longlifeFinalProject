<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class AdminTransactionController extends Controller
{
    // List all transactions
    public function index()
    {
        $transactions = Transaction::all();
        return view('admin.transactions.index', compact('transactions'));
    }


    public function approve($id)
    {
    $transaction = Transaction::findOrFail($id);

    if ($transaction->status !== 'pending') {
        return redirect()->back()->with('error', 'Transaction cannot be processed.');
    }

    // Update the transaction status to "approved"
    $transaction->status = 'approved';
    $transaction->save();

    // Optionally, add logic to credit the user's wallet if necessary
    $user = $transaction->user;
    $user->total_wallet_amount += $transaction->amount;
    $user->save();

    return redirect()->back()->with('success', 'Transaction approved successfully.');
 }

public function cancel($id)
{
    $transaction = Transaction::findOrFail($id);

    if ($transaction->status !== 'pending') {
        return redirect()->back()->with('error', 'Transaction cannot be processed.');
    }

    // Update the transaction status to "canceled"
    $transaction->status = 'canceled';
    $transaction->save();

    return redirect()->back()->with('success', 'Transaction canceled successfully.');
}




    // Verify a transaction
    // public function verify($id)
    // {
    //     $transaction = Transaction::findOrFail($id);
    //     $transaction->status = 'success';
    //     $transaction->verified_at = now();
    //     $transaction->save();

    //     return redirect()->back()->with('message', 'Transaction verified successfully.');
    // }
}

