<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentRequest;
use function PHPUnit\Framework\size;

class PaymentRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|string|unique:payment_requests,transaction_id',
            'mobile_number' => ['required', 'string', 'size:11', 'regex:/^01[3-9]\d{8}$/'],
        ]);

        // পেমেন্ট রিকোয়েস্ট সংরক্ষণ
        PaymentRequest::create([
            'user_id' => auth()->id(),
            'transaction_id' => $request->input('transaction_id'),
            'mobile_number' => $request->input('mobile_number'),
            'status' => 'pending', // বা 'submitted'
        ]);

        $notification = array(
            'message' => 'Payment request submitted successfully. Admin will review it.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
