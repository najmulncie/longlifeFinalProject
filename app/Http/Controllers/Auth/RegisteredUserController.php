<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str; // Added for referral code generation

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ইনপুট ভ্যালিডেশন
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            //'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'regex:/^01[3-9]\d{8}$/'],
            'referral_code' => ['nullable', 'string', 'max:255'], // রেফারেল কোড অপশনাল
        ]);

        // রেফারেল কোড দিয়ে রেফারার সনাক্ত করা
        $referredById = null;
        if ($request->referral_code) {
            $referredById = User::where('referral_code', $request->referral_code)->value('id');
        }

        // নতুন ব্যবহারকারীর জন্য ইউনিক রেফারেল কোড তৈরি করা
        $newReferralCode = Str::random(10); // যেকোনো ইউনিক স্ট্রিং তৈরি করা

        // নতুন ব্যবহারকারী তৈরি করা
        $user = User::create([
            'name' => $request->name,
            //'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'referral_code' => $newReferralCode, // নতুন রেফারেল কোড সেভ
            'referred_by' => $referredById, // যিনি রেফার করেছেন
            'referral_commission' => 0, // নতুন ইউজারের জন্য কমিশন ০
            'is_active' => false, // ডিফল্টভাবে ইউজার নিষ্ক্রিয় (অ্যাকটিভ নয়)
        ]);


        // ইভেন্ট ট্রিগার
        event(new Registered($user));

        // রেফারাল কমিশন অ্যাসাইন করা
        //$this->assignReferralCommission($user);

        // ব্যবহারকারীকে লগইন করা
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


    // রেফারেল কমিশন অ্যাসাইনমেন্ট ফাংশন
    private function assignReferralCommission(User $user)
    {
//        $commissionLevels = [
//            1 => 29,  // প্রথম লেভেলে 29 টাকা
//            2 => 10,  // দ্বিতীয় লেভেলে 10 টাকা
//            3 => 5,   // তৃতীয় লেভেলে 5 টাকা
//            4 => 3,   // চতুর্থ লেভেলে 2 টাকা
//            5 => 2, // পঞ্চম লেভেলে 2 টাকা
//        ];
        $commissionLevels = [
            1 => 70, // প্রথম লেভেলে 70 টাকা
            2 => 30, // দ্বিতীয় লেভেলে 30 টাকা
            3 => 15, // তৃতীয় লেভেলে 15 টাকা
            4 => 10,
            5 => 10,
            6 => 5,
            7 => 5,
            8 => 5,
            9 => 5,
            10 => 3,
        ];
        $referredBy = $user->referred_by; // প্রথম রেফারার সনাক্ত করা
        $level = 1; // লেভেল ট্র্যাকিং করা

        while ($referredBy && $level <= 10) {
            $referrer = User::find($referredBy);

            if ($referrer && $referrer->is_active) { // চেক করুন যে রেফারার সক্রিয় আছে কি না
                $referrer->referral_commission += $commissionLevels[$level];
                $referrer->save(); // সেভ করুন যদি কমিশন যোগ করা হয়
            }

            // পরবর্তী লেভেলের রেফারার সনাক্ত করা
            $referredBy = $referrer ? $referrer->referred_by : null;
            $level++;
        }
    }


}
