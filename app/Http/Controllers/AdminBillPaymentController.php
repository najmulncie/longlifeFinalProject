<?php

namespace App\Http\Controllers;

use App\Models\BillPayment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminBillPaymentController extends Controller
{
    public function index()
    {
        $payments = BillPayment::with('user')->get(); // Fetch all payment requests
        return view('admin.bill-payments.index', compact('payments'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'cashback' => 'required|numeric|min:0', // Ensure cashback is a positive number
        ]);
    
        // Find the payment record
        $payment = BillPayment::findOrFail($id);
    
        // Check if the payment has a valid user_id
        if ($payment->user_id) {
            
            $user = User::find($payment->user_id);
    
            // Update payment status and cashback amount
            $payment->status = 'approved';
            $payment->cashback = $request->cashback;
            $payment->save();
    
            // Check if the user exists
            if ($user) {
                // Add the cashback to the user's main balance
                $user->main_balance += $request->cashback;
                $user->save();
    
                return redirect()->route('admin.payments.index')->with('success', 'Payment approved, and cashback has been added to the user\'s main balance.');
            } else {
                return redirect()->route('admin.payments.index')->with('error', 'User not found. Cashback not applied.');
            }
        } else {
            return redirect()->route('admin.payments.index')->with('error', 'Payment does not have an associated user.');
        }
    }
    


    public function reject($id)
    {
         // Find the payment record
    $payment = BillPayment::findOrFail($id);

    $user = User::find($payment->user_id);

    // Check if the user exists
    if ($user) {
        
        $user->total_wallet_amount += $payment->total_bill;
        $user->save();  
    }

    $payment->status = 'rejected';
    $payment->save();  

        return redirect()->route('admin.payments.index')->with('success', 'Payment request rejected.');
    }
}
