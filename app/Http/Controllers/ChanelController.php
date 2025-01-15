<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\User\UserController;

class ChanelController extends Controller
{
    public function index($userId)
    {
        $user = User::find($userId); // লগইন করা ব্যবহারকারী
        //$referrals = $user->load('referrals.referredBy')->referrals; // রেফার করা ব্যবহারকারীরা

        $levels = []; // রেফারালদের লেভেল রাখার জন্য অ্যারে
        $this->getReferralTree($user, 1, $levels);
//        foreach ($referrals as $referral) {
//            // এখানে কত লেভেলে যুক্ত আছে তা নির্ধারণের জন্য একটি মেথড কল করুন
//            $levels[$referral->id] = $this->calculateReferralLevel($referral);
//        }

        return view('user.chanel.search-results', compact('user', 'levels'));

    }
    private function getReferralTree($user, $level, &$levels)
    {
        if (!isset($levels[$level])) {
            $levels[$level] = [];
        }

        $referrals = $user->referrals; // User er sob referral gula fetch kora

        foreach ($referrals as $referral) {
            $levels[$level][] = $referral; // Current level e user ke add kora
            $this->getReferralTree($referral, $level + 1, $levels); // Recursive call next level er jonno
        }
    }



//    private function calculateReferralLevel($referral)
//    {
//        $level = 1; // লেভেল ১ দিয়ে শুরু হবে
//
//        // যতক্ষণ পর্যন্ত রেফারার আছে, ততক্ষণ লেভেল বৃদ্ধি হবে
//        while ($referral->referredBy) { // 'referredBy' সম্পর্ক কল করুন
//            $referral = $referral->referredBy; // উপরোক্ত রেফারারকে অনুসন্ধান করুন
//            $levels[$level][] = $referral; // লেভেল বৃদ্ধি করুন
//        }
//
//        return $level; // লেভেল রিটার্ন করুন
//    }

    // সার্চ প্রসেস করার জন্য ফাংশন
    public function search(Request $request)
    {
        $query = $request->input('query'); // ইউজারের ইনপুট নেওয়া

        // ইউজার মডেল এ সার্চ করা
        $results = User::where('mobile', 'like', '%' . $query . '%')
            ->orWhere('referral_code', 'like', '%' . $query . '%')
            ->get();

        // AJAX এর মাধ্যমে JSON ফরম্যাটে রেসপন্স রিটার্ন করা
        return response()->json($results);
    }
}
