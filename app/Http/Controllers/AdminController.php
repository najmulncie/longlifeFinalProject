<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\PaymentRequest;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function AdminDashbaord()
    {
        $activeMembers = DB::table('users')
            ->where('is_active', 1)
            ->orderBy('activated_at', 'desc') // Descending order by created_at
            ->get();

        return view('admin.home.index',['activeMembers' => $activeMembers]);
    }//End Method

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function ManageUser()
    {
        $user = User::all();
        return view('admin.user.manage_user', ['users' => $user]);
    }

    public function edit($id)
    {
        // Find the user by ID
        $user = User::find($id);
        // Check if user exists
        if (!$user) {
            return redirect()->route('manage.user')->with('error', 'User not found.');
        }

        // Return the edit view with the user data
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
//            'phone' => 'required|string|max:15',
//            // Add other fields as necessary
//        ]);

        // Find the user by ID
        $user = User::find($id);

        // Check if user exists
        if (!$user) {
            return redirect()->route('manage.user')->with('error', 'User not found.');
        }

        // Update user data
        $user->update($request->except('referral_code')); // Exclude referral_code from the update for now

        // Update referral if provided
        if ($request->filled('referral_code')) {
            // Find the referrer by the referral code
            $referrer = User::where('referral_code', $request->referral_code)->first();
            if ($referrer) {
                $user->referred_by = $referrer->id; // Set the referrer ID
            } else {
                $user->referred_by = null; // If no valid referrer, set to null
            }
        } else {
            $user->referred_by = null; // If no referral code is provided, clear the referrer
        }

        // Save the user
        $user->save();

        // Redirect back with success message
        return redirect()->route('manage.user')->with('success', 'User updated successfully.');
    }



    public function destroy($id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if user exists
        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        // Delete the user
        $user->delete();

        // Redirect back with success message
        return back()->with('success', 'User deleted successfully.');
    }//destroy the user


    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    } //End Method

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.profile.admin_profile', compact('profileData'));
    }//End Method


    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $directory = 'upload/admin_images/';
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move($directory, $fileName);
            $data['photo'] = $fileName;

        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);

    } //End Method

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profile_data = User::find($id);
        return view('admin.profile.admin_change_password', compact('profile_data'));
    } //End Method

    public function AdminUpdatePassword(Request $request)
    {
        //validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        //match old password to new password

        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'Old Password does not matched!',
                'alert-type' => 'error',
            );
            return back()->with($notification);
        }

        //update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }

    // ইউজার সাসপেন্ড করার জন্য
    public function suspendUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_suspended = true;
        $user->save();

        return redirect()->back()->with('success', 'User suspended successfully.');
    }

    // ইউজার আনসাসপেন্ড করার জন্য
    public function unsuspendUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_suspended = false;
        $user->save();

        return redirect()->back()->with('success', 'User unsuspended successfully.');
    }



    public function showApprovedPaymentRequests()
    {
        // শুধুমাত্র approved পেমেন্ট রিকোয়েস্ট গুলি নির্বাচন এবং তাদের সাথে সম্পর্কিত ইউজার ডেটা লোড
        $approvedPayments = PaymentRequest::with('user')->where('status', 'approved') ->orderBy('created_at', 'desc')->get();

        return view('admin.payment_request.approved-payment-requests', compact('approvedPayments'));

    }
    public function showApprovedWithdrawalRequests()
    {
        // শুধুমাত্র approved পেমেন্ট রিকোয়েস্ট গুলি নির্বাচন এবং তাদের সাথে সম্পর্কিত ইউজার ডেটা লোড
        $approvedWithdrawals = Withdrawal::with('user')->where('status', 'approved') ->orderBy('created_at', 'desc')->get();

        return view('admin.withdrawals.withdrawal-approved-requests', compact('approvedWithdrawals'));

    }

    //payment request approve
    public function showPaymentRequests()
    {

        $paymentRequests = PaymentRequest::where('status', 'pending')->get();
        return view('admin.payment_request.payment-requests', compact('paymentRequests'));
    }

    public function approvePayment($id)
    {
        // পেমেন্ট রিকোয়েস্ট খুঁজে বের করুন
        $paymentRequest = PaymentRequest::findOrFail($id);
        $user = User::find($paymentRequest->user_id);

        // ইউজার এক্টিভেট করুন যদি না হয়ে থাকে
        if (!$user->is_active) {
            $user->is_active = true;
            $user->activated_at = now();
            $user->save();

            // কমিশন যুক্ত করার জন্য ইউজারের রেফারাল
            $this->addReferralCommissionToUser($user); // কমিশন যুক্ত করুন
        }

        // পেমেন্ট রিকোয়েস্ট স্ট্যাটাস আপডেট
        $paymentRequest->status = 'approved';
        $paymentRequest->save();

        $notification = array(
            'message'=>'Payment approved and account activated. Commission has been added.',
            'alert-type'=>'info'
        );
        return redirect()->back()->with($notification);
    }

    public function rejectPayment($id)
    {
        // Payment Request খোজা এবং ডিলিট বা স্ট্যাটাস আপডেট
        $paymentRequest = PaymentRequest::findOrFail($id);

        // ডিলিট করা বা স্ট্যাটাস রিজেক্ট করা
        $paymentRequest->delete();
        // অথবা $paymentRequest->update(['status' => 'rejected']); // রিজেক্ট করার জন্য

        // নোটিফিকেশন দেখানো
        $notification = array(
            'message' => 'Payment request has been rejected/deleted successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    private function addReferralCommissionToUser($user)
    {
        $commissionLevels = [1 => 70, 2 => 30, 3 => 15, 4 => 10, 5 => 10, 6 => 5, 7 => 5, 8 => 5, 9 => 5, 10 => 3 ]; // কমিশন লেভেল
        $referredBy = $user->referred_by; // প্রথম রেফারার সনাক্ত করা
        $level = 1; // লেভেল ট্র্যাকিং করা

        while ($referredBy && $level <= 10) {
            $referrer = User::find($referredBy);

            if ($referrer && $referrer->is_active) { // চেক করুন যে রেফারার সক্রিয় আছে কি না
                $referrer->referral_commission += $commissionLevels[$level]; // কমিশন যোগ করুন
                $referrer->save(); // সেভ করুন যদি কমিশন যোগ করা হয়
                Log::info("Commission of {$commissionLevels[$level]} added to referrer: " . $referrer->id . " at level " . $level);
            }

            // পরবর্তী লেভেলের রেফারার সনাক্ত করা
            $referredBy = $referrer ? $referrer->referred_by : null;
            $level++;
        }
    }

// রেফারেল কমিশন গণনার মেথড
    private function calculateReferralCommission($user, $levels, $level, &$totalCommission)
    {
        if ($level > count($levels)) {
            return;
        }

        // কমিশন যোগ করতে যাচ্ছি, তাই ইউজারের এক্টিভেশন চেক
        if (!$user->is_active) {
            return; // ইউজার এক্টিভ না হলে কমিশন যুক্ত না
        }

        // রেফারেল ইউজারদের সংগ্রহ করুন
        $referrals = $user->referrals;

        foreach ($referrals as $referral) {
            // কমিশন যোগ করতে যাচ্ছি, যদি না ইতিমধ্যে যোগ হয়ে থাকে
            //$totalCommission += $levels[$level]; // লেভেল অনুযায়ী কমিশন যোগ
            if ($referral->referral_commission > 0) { // নিশ্চিত করুন যে কমিশন ইতিমধ্যে যোগ হয়নি
                $totalCommission += $levels[$level]; // লেভেল অনুযায়ী কমিশন যোগ
            }
            // পুনরায় রেফারাল কমিশন গণনা করুন
            $this->calculateReferralCommission($referral, $levels, $level + 1, $totalCommission);
        }
    }


//// কমিশন গণনার মেথড
//    private function calculateReferralCommission($user, $levels, $level, &$totalCommission)
//    {
//        if ($level > count($levels)) {
//            return;
//        }
//
//        if (!$user->is_active) {
//            return; // ইউজার এক্টিভ না হলে কমিশন যুক্ত হবে না
//        }
//
//        $referrals = $user->referrals; // রেফারেল ইউজারদের সংগ্রহ
//
//        foreach ($referrals as $referral) {
//            if ($referral->referral_commission > 0) { // নিশ্চিত করুন যে কমিশন ইতিমধ্যে যোগ হয়নি
//                $totalCommission += $levels[$level]; // লেভেল অনুযায়ী কমিশন যোগ
//            }
//            $this->calculateReferralCommission($referral, $levels, $level + 1, $totalCommission);
//        }
//    }
//

    // Display all withdrawal requests
    public function index()
    {
        $withdrawals = Withdrawal::with('user')->where('status', 'pending')->get();
        return view('admin.withdrawals.index', compact('withdrawals'));
    }



    public function approve($id)
    {
        DB::transaction(function () use ($id) {
            $withdrawal = Withdrawal::findOrFail($id);

            // Approve the withdrawal
            $withdrawal->status = 'approved';
            $withdrawal->save();

            // Deduct user's balance after admin approval
            $user = $withdrawal->user;
            $user->amount -= $withdrawal->amount;
            $user->save();
        });

        return redirect()->back()->with('success', 'Withdrawal approved successfully.');
    }

    public function reject($id)
    {
        DB::transaction(function () use ($id) {
            $withdrawal = Withdrawal::findOrFail($id);

            // Reject the withdrawal
            $withdrawal->status = 'rejected';
            $withdrawal->save();

            // Return the balance to the user in case of rejection
            $user = $withdrawal->user;
            $user->amount += $withdrawal->amount;
            $user->save();
        });

        return redirect()->back()->with('success', 'Withdrawal request rejected and amount added back to the balance.');
    }





}
