<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillPayment;

class BillPaymentController extends Controller
{
    // Show the payment form
    public function index()
    {
        // Operators (you can replace this with a database table if needed)
        $operators = ['পানি বিল', 'গ্যাস বিল', 'বৈদ্যুতিক বিল'];
        
        return view('user.bill-payment.index', compact('operators'));
    }

    public function processPayment(Request $request)
    {
        // Validate the input
        $request->validate([
            'bill_no' => 'required|string',
            'mobile_number' => 'required|string|min:10|max:15',
            'operator' => 'required|string',
            'total_bill' => 'required|numeric',
            'address' => 'required|string',
            'terms' => 'accepted',
        ]);
    
        // Get the logged-in user
        $user = auth()->user();
    
        // Check if the user has enough balance
        if ($user->total_wallet_amount < $request->total_bill) {
            return back()->withErrors(['insufficient_balance' => 'আপনার ওয়ালেটে পর্যাপ্ত ব্যালেন্স নেই।'])->withInput();
        }
    
        // Deduct the total bill amount from the wallet balance
        $user->total_wallet_amount -= $request->total_bill;
        $user->save();
    
        // Save the payment details in the database
        BillPayment::create([
            'bill_no' => $request->bill_no,
            'mobile_number' => $request->mobile_number,
            'operator' => $request->operator,
            'total_bill' => $request->total_bill,
            'address' => $request->address,
            'user_id' => $user->id,
        ]);
    
        // Return a success response
        return redirect()->route('bill.payment')->with('success', 'পেমেন্ট সফলভাবে সম্পন্ন হয়েছে!');
    }

    public function paymentHistory()
    {
        $user = auth()->user();

        $payments = BillPayment::where('user_id', $user->id)
            ->orderBy('created_at', 'desc') 
            ->get();

        return view('user.bill-payment.payment-history', compact('payments'));
    }

    
}
