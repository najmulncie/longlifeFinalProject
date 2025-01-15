<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\bkashTaskModel;
use App\Models\Income;
use App\Models\nagodTaskModel;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Console\Style\success;
use App\Models\Task;


class UserController extends Controller
{
    public function UserDashboard()
    {
        $bkashTasks = bkashTaskModel::latest()->first();
        $nagodTasks = nagodTaskModel::latest()->first();

        $sections = Section::all();
        $banners = Banner::all();
        return view('user.home.index',[
            'bkashTask' => $bkashTasks,
            'nagodTask' => $nagodTasks,
            'sections' => $sections,
            'banners' => $banners,
        ]);

    }//End Method


    public function UserLogout(Request $request)
    {
       Auth::guard('web')->logout();

       $request->session()->invalidate();

       $request->session()->regenerateToken();

       return redirect('/login');
    } //End Method

    public function UserProfile()
   {
      $id = Auth::user()->id;
      $profileData = User::find($id);
      return view('user.profile.user_profile', compact('profileData'));
   }//End Method


   public function UserProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
              @unlink(public_path('upload/user_images/'.$data->photo));
            $directory = 'upload/user_images/';
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move($directory, $fileName);
            $data['photo'] = $fileName;

        }
        $data->save();

        $notification = array(
            'message' => 'user Profile Updated Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);

    } //End Method

   public function UserChangePassword(){
      $id = Auth::user()->id;
      $profile_data = User::find($id);
      return view('user.profile.user_change_password', compact('profile_data'));
   } //End Method

  public function UserUpdatePassword(Request $request){
      //validation
      $request->validate([
          'old_password' => 'required',
          'new_password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);

      //match old password to new password

      if(!Hash::check($request->old_password, auth::user()->password)){
          $notification = array(
              'message' => 'Old Password does not matched!',
              'alert-type' => 'success',
          );
          return back()->with($notification);
      }

      //update the new password
      User::whereId(auth()->user()->id)->update([
          'password'=> Hash::make($request->new_password)
      ]);
      $notification = array(
          'message' => 'Password Changed Successfully',
          'alert-type' => 'danger',
      );
      return back()->with($notification);
  }



     public function UserWithdraw()
    {
      return view('user.withdraw.withdraw');
    }

    public function withdraw(Request $request)
  {
        // Validate the withdrawal request
        $request->validate([
            'amount' => 'required|numeric|min:200',
            'mobile_number' => 'required|string|size:11|regex:/^01[3-9]\d{8}$/',
            'payment_method' => 'required|string|in:bKash,Nagad,Bank_Transfer'
        ], [
            'amount.min' => 'You cannot withdraw less than 200 BDT.',
            'amount.required' => 'Please enter a withdrawal amount.',
            'amount.numeric' => 'The withdrawal amount must be a number.',
            'mobile_number.required' => 'Please enter your mobile number.',
            'mobile_number.regex' => 'Please enter a valid mobile number.',
            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in' => 'Please select a valid payment method (bKash, Nagad, Bank Transfer).'
        ]);

        // Retrieve the user ID and withdrawal amount from the request
        $userId = $request->user()->id;
        $withdrawAmount = $request->input('amount');
        $mobileNumber = $request->input('mobile_number');
        $paymentMethod = $request->input('payment_method');

        // Start a database transaction
        return DB::transaction(function () use ($userId, $withdrawAmount, $mobileNumber, $paymentMethod) {
            // Lock the user's balance for update
            $user = DB::table('users')->where('id', $userId)
                ->lockForUpdate()->first();

            // Check if the user is active
            if ((int) $user->is_active !== 1) {
                $notification = array(
                    'message' => 'Your account is not approved by the admin yet. You cannot withdraw funds.',
                    'alert-type' => 'success',
                );
                return redirect()->back()->with($notification);
            }

            // Check if the user has sufficient balance
            if ($user->main_balance >= $withdrawAmount) {
                // Deduct the balance
                DB::table('users')->where('id', $userId)->update([
                    'main_balance' => $user->main_balance - $withdrawAmount
                ]);

                // Record the withdrawal (assuming you have a withdrawals table)
                DB::table('withdrawals')->insert([
                    'user_id' => $userId,
                    'amount' => $withdrawAmount,
                    'mobile_number' => $mobileNumber,
                    'payment_method' => $paymentMethod,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                $notification = array(
                    'message' => 'Your withdrawal of ' . $withdrawAmount . ' BDT was successful.',
                    'alert-type' => 'success',
                );
                return redirect()->back()->with($notification);
            } else {
                $notification = array(
                    'message' => 'You do not have sufficient balance to withdraw ' . $withdrawAmount . ' BDT. Please check your balance and try again.',
                    'alert-type' => 'success',
                );
                return redirect()->back()->with($notification);
            }
        });
    }


    public function withdrawHistory()
    {
        $withdrawals = Withdrawal::with('user')->where('user_id', auth()->id())->latest()->get();
        return view('user.withdraw.history', compact('withdrawals'));
    }

    // Referral Tree দেখানোর জন্য মেথড (অপরিবর্তিত)
    public function showReferralTree($userId)
    {
        // ইউজারকে খুঁজে বের করুন
        $user = User::with(['referrals.referredBy'])->find($userId);

        if (!$user) {
            abort(404, 'User not found');
        }

        // লেভেল অনুযায়ী কমিশন নির্ধারণ
//        $levels = [
//            1 => 29,
//            2 => 10,
//            3 => 5,
//            4 => 3,
//            5 => 2,
//        ];
        $levels = [
            1 => 70,
            2 => 40,
            3 => 20,
            4 => 15,
            5 => 10,
            6 => 5,
            7 => 2,
            8 => 2,
            9 => 2,
            10 => 2,
        ];
        // মোট কমিশন গণনা
        $totalCommission = 0;
        $this->calculateReferralCommission($user, $levels, 1, $totalCommission);

        // সেশন ভেরিয়েবল সেট করুন
        session(['totalCommission' => $totalCommission]);

        // রেফারেল ডাটাগুলি সংগ্রহ করুন
        $referrals = $this->getReferralTree($user, 1);


        // ডিফল্ট ৫টি লেভেলের জন্য সমতল ফরম্যাটে লেভেল অনুযায়ী ডাটা প্রস্তুত
        $levelsSummary = collect($referrals)
            ->map(function ($referral) {
                return $this->flattenReferralTree($referral);
            })
            ->flatten(1)
            ->groupBy('level')
            ->map(function ($group) {
                return [
                    'active' => $group->where('is_active', 1)->count(),
                    'inactive' => $group->where('is_active', 0)->count(),
                    'members' => [
                        'active' => $group->where('is_active', 1)->values()->map(function ($member) {
                            return [
                                'name' => isset($member['name']) ? $member['name'] : 'নাম পাওয়া যায়নি', // অ্যারে থেকে নাম চেক করুন
                                'is_active' => $member['is_active'],
                            ];
                        })->all(), // সক্রিয় সদস্যদের নাম
                        'inactive' => $group->where('is_active', 0)->values()->map(function ($member) {
                            return [
                                'name' => isset($member['name']) ? $member['name'] : 'নাম পাওয়া যায়নি', // অ্যারে থেকে নাম চেক করুন
                                'is_active' => $member['is_active'],
                            ];
                        })->all()  // অকার্যকর সদস্যদের নাম
                    ]// সদস্যদের নামের জন্য
                ];
            })
            ->filter(function ($count, $level) {
                return $level <= 10; // লেভেল 10 এর উপরে কিছু আসলে তা বাদ
            })
            ->union(collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])->flip()->map(function () {
                return ['active' => 0, 'inactive' => 0,  'members' => ['active' => [], 'inactive' => []]];;
            }))
            ->sortKeys();

        // সক্রিয় সদস্যদের নামগুলো পেতে
        $activeMembers = $levelsSummary->flatMap(function ($levelData) {
            return $levelData['members']['active'];
        });

        // অকার্যকর সদস্যদের নামগুলো পেতে
        
        $inactiveMembers = $levelsSummary->flatMap(function ($levelData) {
            return $levelData['members']['inactive'];
        });

        // ভিউতে রেফারেল, লেভেল এবং টোটাল কমিশন পাঠানো হচ্ছে
        return view('user.referrals.referral_tree', compact('user', 'referrals', 'levelsSummary', 'activeMembers','inactiveMembers'))
            ->with('totalCommission', $totalCommission);
    }

    private function flattenReferralTree($referral, $level = 1)
    {
        if ($level > 10) {
            return collect(); // যদি লেভেল ৫-এর উপরে যায়, কিছুই ফেরত না দিন
        }

        // ইউজারের তথ্য সংগ্রহ করুন
        $userData = [
            'name' => $referral->user->name ?? 'No Name Available', // ইউজারের নাম যাচাই করুন
            'is_active' => $referral->user->is_active ?? 0, // ইউজারের স্ট্যাটাস যুক্ত করুন
            'level' => $level
        ];

        $flattened = collect([$userData]); // প্রথম স্তরের ইউজারের তথ্য

        foreach ($referral->children as $child) {
            $flattened = $flattened->merge($this->flattenReferralTree($child, $level + 1));
        }

        return $flattened;
    }

    // কমিশন যোগ করে মুল ব্যালেন্সে পাঠানোর জন্য মেথড
    public function addCommissionToBalance($userId)
    {
        // ইউজার খুঁজে বের করুন
        $user = User::findOrFail($userId);

        // চেক করুন ইউজার সক্রিয় কি না
        if (!$user->is_active) {
            // কমিশন শূন্য করার যুক্তি
            $user->referral_commission = 0; // কমিশন শূন্য করুন
            $user->save();

            $notification = array(
                'message' => 'User is not active, cannot add commission.',
                'alert-type' => 'error', // alert type change for error
            );
            return redirect()->back()->with($notification);
        }

        // লেভেল অনুযায়ী কমিশন নির্ধারণ
        $levels = [
            1 => 70,
            2 => 40,
            3 => 20,
            4 => 15,
            5 => 10,
            6 => 5,
            7 => 2,
            8 => 2,
            9 => 2,
            10 => 2,
        ];

        // মোট কমিশন গণনা
        $totalCommission = 0;
        $this->calculateReferralCommission($user, $levels, 1, $totalCommission);

        // কমিশন চেক করুন
        if ($totalCommission <= 0) {
            // কমিশন না থাকলে একটি মেসেজ দেখান
            $notification = array(
                'message' => 'No commission available to add.',
                'alert-type' => 'info',
            );
            return redirect()->back()->with($notification);
        }

        // কমিশন যোগ করুন এবং রিসেট করুন
        DB::transaction(function () use ($user, $totalCommission) {
            $user->main_balance += $totalCommission;
            $user->referral_commission = 0; // কমিশন রিসেট করুন
            //$this->resetReferralCommission($user); // রেফারেল কমিশন রিসেট হচ্ছে
            $user-> save(); // ইউজার সেভ করুন
        });

        // Income মডেলে নতুন এন্ট্রি তৈরি করুন
        Income::create([
            'user_id' => $user->id, // যাকে কমিশন দেওয়া হচ্ছে
            'amount' => $totalCommission, // যোগ করা কমিশন
            'type' => 'referral', // ইনকামের টাইপ
            'source' => 'referral_commission', // সোর্সের মান
        ]);


        // কমিশন সেশন থেকে রিসেট করুন
        session(['totalCommission' => 0]);

        // সফলতার মেসেজ দেখান
        $notification = array(
            'message' => 'Commission added to your main balance and deducted from referral balance.',
            'alert-type' => 'success',
        );


        return redirect()->back()->with($notification);
    }

    private function calculateReferralCommission($user, $levels, $level, &$totalCommission)
    {
        // চেক করুন, লেভেল সর্বোচ্চ লেভেল অতিক্রম করেছে কিনা
        if ($level > count($levels)) {
            return;
        }

        // নিশ্চিত করুন যে ইউজার অ্যাক্টিভ আছে এবং রেফারাল কমিশন > 0
        if (!$user->is_active || $user->referral_commission <= 0) {
            return; // ইউজার এক্টিভ না হলে কমিশন যোগ করবেন না
        }
        if ($user->referral_commission > 0 && $user->is_active) {
            $totalCommission += $user->referral_commission;
        }

        // ইউজারের সব রেফারেল সংগ্রহ করুন
        $referrals = $user->referrals;

        foreach ($referrals as $referral) {
            // চেক করুন রেফারেলের কমিশন যোগ করা যায় কিনা
            if ($referral->referral_commission > 0 && $referral->is_active) {
                $totalCommission += $levels[$level]; // লেভেল অনুযায়ী কমিশন যোগ করুন
                // লেভেল ভিত্তিক কমিশন যোগ করার জন্য রিকার্সিভ কল
                $this->calculateReferralCommission($referral, $levels, $level + 1, $totalCommission);
            }
        }

    }


    // কমিশন রিসেট করার মেথড
    private function resetReferralCommission($user)
    {
        // মূল ইউজারের কমিশন শূন্য
        $user->referral_commission = 0;
        $user->save();

        // ইউজারের সব রেফারেল সংগ্রহ করুন
        $referrals = $user->referrals;

        foreach ($referrals as $referral) {
            // রেফারেলের কমিশন রিসেট
            $referral->referral_commission = 0; // কমিশন শুন্য করুন
            $referral->save();

            // রিকর্শন কল করুন, যদি তার রেফারেল থাকে
            $this->resetReferralCommission($referral);
        }
    }

    // রেফারেল ট্রি সংগঠনের মেথড
    private function getReferralTree($user, $level)
    {
        $referralUsers = $user->referrals;
        $tree = [];

        foreach ($referralUsers as $referralUser) {
            $referralData = new \stdClass();
            $referralData->user = $referralUser;
            $referralData->level = $level;
            $referralData->children = $this->getReferralTree($referralUser, $level + 1);
            $tree[] = $referralData;
        }

        return $tree;
    }

    public function checkAndAddBonus($user)
    {
        // লেভেল ২ এর রেফারালদের সংখ্যা গণনা করা
        $level2ReferralsCount = $this->getLevel2ReferralsCount($user);

        // ২৫ এর গুণিতক কিনা তা চেক করা
        if ($level2ReferralsCount > 0 && $level2ReferralsCount % 25 === 0) {
            // বোনাস অ্যাড করা
            $user->main_balance += 1000;
            $user->save();

            // এডেড বোনাসের মেসেজ বা লগিং করা যেতে পারে
            return "1000 টাকা সফলভাবে মূল ব্যালেন্সে যোগ করা হয়েছে!";
        }

        return "বোনাস যোগ করার জন্য প্রয়োজনীয় সংখ্যা পূরণ হয়নি।";
    }

// লেভেল ২ রেফারাল সংখ্যা গণনার ফাংশন
    private function getLevel2ReferralsCount($user)
    {
        $level2Referrals = 0;

        // লেভেল ১ রেফারালদের সকল রেফারালের সংখ্যা বের করা
        foreach ($user->referrals as $level1Referral) {
            $level2Referrals += $level1Referral->referrals()->count();
        }

        return $level2Referrals;
    }

}



//    public function withdraw(Request $request)
//    {
//        // Validate the withdrawal request
//        $request->validate([
//            'amount' => 'required|numeric|min:10',
//        ]);
//
//        $user = auth()->user();
//        $amount = $request->input('amount');
//
//        // Calculate total commission from referrals
//        $referralCount = $user->referrals()->count();
//        $totalCommission = $referralCount * 10;  // প্রতি রেফারেলে ১০ টাকা
//
//        // Check if user is trying to withdraw less than the minimum
//        if ($amount < 10) {
//            return redirect()->back()->with('error', 'You must withdraw at least 10 BDT.');
//        }
//
//        // Check if user has enough referral-based balance to withdraw
//        if ($totalCommission < $amount) {
//            return redirect()->back()->with('error', 'You do not have enough balance to withdraw this amount.');
//        }
//
//        // Deduct the withdrawal amount from user's referral commission
//        $user->amount -= $amount;
//        $user->save();
//
//        // Create withdrawal request with pending status
//        Withdrawal::create([
//            'user_id' => $user->id,
//            'amount' => $amount,
//            'status' => 'pending',
//        ]);
//
//        return redirect()->back()->with('success', 'Your withdrawal request is submitted. Please wait for approval.');
//    }




    //withdraw user process
//    public function withdraw(Request $request)
//    {
//        // Validate the request
//        $request->validate([
//            'amount' => 'required|numeric|min:1',
//        ]);
//
//        $user = auth()->user();
//        $amount = $request->input('amount');
//
//        // Calculate user's total referral commission
//        $referralCount = $user->referrals()->count();
//        $totalCommission = $referralCount * 10; // প্রতি রেফারেলে ১০ টাকা
//
//
//        // Check if the amount is greater than or equal to 200
//        if ($amount < 10) {
//            return redirect()->back()->with('error', 'You must withdraw at least 200 BDT.');
//        }
//
//        // Check if the user has enough referral-based balance
//        if ($totalCommission < $amount) {
//            return redirect()->back()->with('error', 'You do not have enough balance to withdraw this amount.');
//        }
//
//        // Deduct the amount from user's balance (assuming amount field exists)
//        $user->amount += $amount; // Amount ফিল্ডে পরিমাণ যোগ করা হচ্ছে
//        $user->save(); // পরবর্তীতে ডাটাবেসে সেভ করা হচ্ছে
//        // Deduct the amount from user's balance (commission)
//        // $user->commission -= $amount;
//        // $user->save();
//
//        // Success message
//        return redirect()->back()->with('success',
//            'Withdrawal successful! You have withdrawn ' . $amount . ' BDT.'.
//            'please wait'
//        );
//    }



