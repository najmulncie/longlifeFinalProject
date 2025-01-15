<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Auth;


class ReferralController extends Controller
{
    public function showBonus()
    {
        $user = Auth::user();

        // লেভেল ২ রেফারাল সংখ্যা বের করা
        $level2ReferralsCount = $this->getLevel2ReferralsCount($user);

        // লেভেল ২ এ একটিভ রেফারাল সংখ্যা বের করা
        $activeLevel2ReferralsCount = $this->getActiveLevel2ReferralsCount($user);

        // বোনাস চেক এবং অ্যাড করা
        $bonusMessage = $this->checkAndAddBonus($user);

        return view('user.referrals.bonus', compact('level2ReferralsCount', 'activeLevel2ReferralsCount', 'bonusMessage'));
    }

    private function getLevel2ReferralsCount($user)
    {
        $level2Referrals = 0;

        foreach ($user->referrals as $level1Referral) {
            $level2Referrals += $level1Referral->referrals()->count();
        }

        return $level2Referrals;
    }



    public function checkAndAddBonus($user)
    {
        // চেক করুন ব্যবহারকারীর অ্যাকাউন্ট একটিভ কিনা
        if (!$user->is_active) {
            return "আপনার অ্যাকাউন্ট এখনও একটিভ নয়, তাই বোনাস যোগ করা সম্ভব নয়।";
        }

        // একটিভ লেভেল ২ রেফারাল সংখ্যা গণনা
        $activeLevel2ReferralsCount = $this->getActiveLevel2ReferralsCount($user);

        // চেক করুন ২৫ জনের নতুন গুনিতক পূরণ হয়েছে কিনা
        $requiredReferralsForBonus = 2;
        if ($activeLevel2ReferralsCount >= $user->level2_bonus_counter + $requiredReferralsForBonus) {
            // মূল ব্যালেন্সে ১০০০ টাকা যোগ করুন
            $user->main_balance += 1000;

            // level2_bonus_counter আপডেট করুন
            $user->level2_bonus_counter += $requiredReferralsForBonus;

            $user->save();

            return "১০০০ টাকা সফলভাবে মূল ব্যালেন্সে যোগ করা হয়েছে!";
        }

        return "বোনাস যোগ করার জন্য প্রয়োজনীয় সংখ্যা পূরণ হয়নি।";
    }

// লেভেল ২-এ একটিভ রেফারাল সংখ্যা গণনা করা
    private function getActiveLevel2ReferralsCount($user)
    {
        $activeLevel2Referrals = 0;

        foreach ($user->referrals as $level1Referral) {
            // লেভেল ১-এর প্রতিটি রেফারাল থেকে একটিভ লেভেল ২ রেফারাল সংখ্যা গুনুন
            $activeLevel2Referrals += $level1Referral->referrals()->where('is_active', 1)->count();
        }

        return $activeLevel2Referrals;
    }






    // My referral logic
    public function my_refer()
    {
        $user = auth()->user();
        $referrals = $user->referrals; // All referrals of the user
        $referralCount = $referrals->count();

//        // Instead of fixed 10, it will now calculate based on generation if needed later
//        $commissionEarned = $referralCount * 10; // Total earned commission for now
//
//        // Calculate the total amount withdrawn by the user
//        $commissionDeducted = $user->withdrawals()->sum('amount');
//
//        if (!$user->has_commission_added) {
//            DB::transaction(function () use ($user, $commissionEarned) {
//                // Update the user's main balance
//                $user->main_balance += $commissionEarned;
//                $user->has_commission_added = true; // Set a flag indicating commission has been added
//                $user->save();
//            });
//        }
//
//        $balance = $user->main_balance - $commissionDeducted;

//        return view('user.referrals.my_refer', compact('user', 'referrals', 'commissionEarned', 'commissionDeducted', 'balance'));
        return view('user.referrals.my_refer', compact('user', 'referrals'));
    }

    // Method to add a referral
    public function addReferral($referrerId, $referredUserId)
    {
        // Logic to add the referred user
        $referrer = User::find($referrerId);
        $referredUser = User::find($referredUserId);

        // Ensure that the referred user is not self or already referred
        if ($referrer && $referredUser && $referrerId != $referredUserId) {
            $referredUser->referred_by = $referrer->id;
            $referredUser->save();

            // Add 10 units to referrer's main balance for the referral
            $referrer->main_balance += 0;
            $referrer->save();
        }
    }

    // Add referral commission recursively based on generation
    public function addReferralCommission($user, $generation = 1) {
        if ($generation > 5 || !$user->referredBy) {
            return; // Limit to 5 generations
        }

        // Get the commission amount for the specific generation
        $commission = $this->getCommissionByGeneration($generation);

        // Add commission to the referrer's main balance
        $user->referredBy->main_balance += $commission;
        $user->referredBy->save();

        // Recursively add commission for the next generation
        $this->addReferralCommission($user->referredBy, $generation + 1);
    }

    // Define commission amounts for each generation
    private function getCommissionByGeneration($generation) {
        switch ($generation) {
            case 1:
                return 29;
            case 2:
                return 10;
            case 3:
                return 5;
            case 4:
                return 2;
            default:
                return 0;
        }
    }





}
