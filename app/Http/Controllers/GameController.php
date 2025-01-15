<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bet;

class GameController extends Controller
{
    // গেমের হোমপেজ
    public function index()
    {
        return view('user.game.lucky-royel.index');
    }

    // বিট করার প্রসেস
    public function placeBet(Request $request)
    {
        $user = auth()->user();
        $amount = $request->amount;

        // চেক করুন ইউজারের ওয়ালেট ব্যালেন্স আছে কিনা
        if ($user->total_wallet_amount < $amount) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }

        // বিটের জন্য ব্যালেন্স কেটে নিন
        $user->total_wallet_amount -= $amount;
        $user->save();

        // লাভ বা লস নির্ধারণ
        $win = rand(0, 1); // র‍্যান্ডমভাবে লাভ বা লস
        $status = $win ? 'win' : 'loss';
        $profit = $win ? $amount * 0.84 : 0;

        // আপডেট করুন লাভের এমাউন্ট
        $user->total_wallet_amount += $amount + $profit;
        $user->save();

        // বিট হিস্ট্রিতে যোগ করুন
        Bet::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'status' => $status,
        ]);

        return response()->json([
            'status' => $status,
            'new_balance' => $user->total_wallet_amount,
        ]);
    }

    // বিট হিস্ট্রি দেখানোর জন্য
    public function betHistory()
    {
        $bets = auth()->user()->bets()->latest()->get();
        return view('guser.game.lucky-royel.history', compact('bets'));
    }
}
