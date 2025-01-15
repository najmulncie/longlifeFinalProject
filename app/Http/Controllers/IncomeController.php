<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Transaction;
use Carbon\Carbon;
use Auth;

class IncomeController extends Controller
{
    public function index()
    {
        $currentBalance = Auth::user()->main_balance;
        return view('user.income.all', compact('currentBalance'));
    }

    public function walletMoney()
    {
        // Fetch the main balance for the user
        $user = auth()->user();
        $mainBalance = $user->main_balance;

        // Calculate the total approved payments (i.e., successful transactions)
        $totalApprovedPayments = Transaction::where('user_id', $user->id)
                                            ->where('status', 'approved')
                                            ->sum('amount');

        // Fetch the total wallet balance (current balance in the wallet)
        $totalWalletBalance = $user->wallet_balance;

        // Fetch the total transferred amount, assuming this is stored in 'total_wallet_amount' 
        $totalTransferredAmount = $user->total_wallet_amount;

        // Pass all the required data to the view
        return view('user.income.wallet_money', compact('mainBalance', 'totalApprovedPayments', 'totalWalletBalance', 'totalTransferredAmount', 'user'));
    }


    // আজকের ইনকাম
    public function getTodayIncome()
    {
        $todayIncome = Income::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');

        return view('user.income.today', compact('todayIncome'));
    }

    // গতকালের ইনকাম
    public function getYesterdayIncome()
    {
        $yesterdayIncome = Income::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::yesterday())
            ->sum('amount');

        return view('user.income.yesterday', compact('yesterdayIncome'));
    }

    // গত ৭ দিনের ইনকাম
    public function getLast7DaysIncome()
    {
        $last7DaysIncome = Income::where('user_id', Auth::id())
            ->whereDate('created_at', '>=', Carbon::today()->subDays(7))
            ->sum('amount');

        return view('user.income.last7days', compact('last7DaysIncome'));
    }

    // গত ৩০ দিনের ইনকাম
    public function getLast30DaysIncome()
    {
        $last30DaysIncome = Income::where('user_id', Auth::id())
            ->whereDate('created_at', '>=', Carbon::today()->subDays(30))
            ->sum('amount');

        return view('user.income.last30days', compact('last30DaysIncome'));
    }

    // সর্বমোট ইনকাম
    public function getTotalIncome()
    {
        $totalIncome = Income::where('user_id', Auth::id())
            ->sum('amount');

        return view('user.income.total', compact('totalIncome'));
    }

    // বর্তমান ব্যালেন্স
    public function getCurrentBalance()
    {
        $currentBalance = Auth::user()->main_balance;

        return view('user.income.all', compact('currentBalance'));
    }

    // ইনকাম ইতিহাস
    public function getIncomeHistory()
    {
        $incomeHistory = Income::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc') // নতুন থেকে পুরানো ক্রমে সাজানো
            ->get();

        return view('user.income.history', compact('incomeHistory'));
    }

    public function paymentInstruction()
    {
        return view('user.income.payment_instruction');
    }



    // Method to handle the verification of transaction
    public function verifyTransaction(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'amount' => 'required|numeric',
        'transaction_id' => 'required|string',
        'payment_method' => 'required|string|in:nagad,bkash,rocket', // Ensure the method is one of the valid options
    ]);

    // Save the transaction details to the database
    $transaction = new Transaction();
    $transaction->transaction_id = $request->transaction_id;
    $transaction->amount = $request->amount;
    $transaction->payment_method = $request->payment_method; // Save the selected payment method
    $transaction->status = 'pending'; // Set the status to 'pending' initially
    $transaction->user_id = auth()->id(); // Associate the transaction with the logged-in user
    $transaction->save();

    // Show a waiting message to the user
    return redirect()->back()->with('message', 'Your transaction is being verified. Please wait.');
}

public function paymentHistory()
{
    $transactions = Transaction::latest()->get();
    
    // Calculate the total approved payments
    $totalApprovedPayments = Transaction::where('user_id', auth()->id())
    ->where('status', 'approved')
    ->sum('amount');

    return view('user.transaction.transactions', compact('transactions', 'totalApprovedPayments'));
}

public function transferToWallet(Request $request)
{
    $request->validate([
        'transfer_amount' => 'required|numeric|min:1',
    ]);

    $user = auth()->user();
    $transferAmount = $request->input('transfer_amount');

    if ($user->main_balance >= $transferAmount) {
        // Deduct from main balance
        $user->main_balance -= $transferAmount;

        // Add to wallet balance
        $user->wallet_balance += $transferAmount;

        // Update total wallet amount
        $user->total_wallet_amount = $user->total_wallet_amount + $transferAmount;

        // Save the user data
        $user->save();

        return redirect()->back()->with('success', 'Amount transferred successfully!');
    }

    return redirect()->back()->with('error', 'Insufficient balance.');
}


// public function transferToWallet(Request $request)
// {
//     $request->validate([
//         'amount' => 'required|numeric|min:1',
//     ]);

//     $user = auth()->user();
//     $amount = $request->input('amount');

//     // Check if the user has enough balance
//     if ($user->main_balance < $amount) {
//         return back()->with('error', 'Insufficient balance.');
//     }

//     // Deduct the amount from the main balance and add it to the wallet
//     $user->main_balance -= $amount;
//     $user->amount += $amount;
//     $user->save();

//     return back()->with('success', 'Amount transferred to wallet successfully.');
// }

// public function allTransaction()
// {
//     return view('admin.transactions.all');
// }

}

