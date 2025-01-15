<?php

namespace App\Http\Controllers;


use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class NotificationController extends Controller
{
    // Notification তালিকা দেখানোর জন্য
    public function index()
    {
        $notifications = Notification::latest()->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    // নতুন Notification এড করার জন্য
    public function create()
    {
        return view('admin.notifications.create');
    }

    // Notification সংরক্ষণের জন্য
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ফর্মের সমস্ত ডেটা সংরক্ষণ
        $data = $request->only(['title', 'description']);

        // ইমেজ ফাইল চেক ও মুভ করা
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // পূর্ববর্তী ইমেজ মুছে ফেলা (যদি থাকে)
            if (!empty($data['photo'])) {
                @unlink(public_path('upload/admin_images/notification/' . $data['photo']));
            }

            // ডিরেক্টরি ও ফাইল নাম নির্ধারণ
            $directory = 'upload/admin_images/notification/';
            $fileName = date('YmdHi') . $file->getClientOriginalName();

            // ফাইল মুভ করা
            $file->move(public_path($directory), $fileName);

            // ফাইলের নাম ডাটাবেজে সেভের জন্য প্রস্তুত
            $data['image'] = $fileName;
        }

        // নতুন নোটিফিকেশন তৈরি এবং সেটি `notification` এ সংরক্ষণ
        $notification = Notification::create($data);

        // প্রতিটি ব্যবহারকারীর জন্য একটি এন্ট্রি তৈরি করুন
        $users = User::all();
        foreach ($users as $user) {
            $user->notifications()->attach($notification->id);
        }

        // ইউজারকে সফলতার মেসেজ সহ পুনঃনির্দেশনা
        return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');
    }


    // Notification ডিলিটের জন্য
    public function destroy(Notification $notification)
    {
        if ($notification->image) {
            Storage::disk('public')->delete($notification->image);
        }

        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }

    public function show($id)
    {

        // বর্তমান ইউজারের নির্দিষ্ট নোটিফিকেশন খুঁজুন
//        $notification = auth()->user()->notifications()->findOrFail($id);

        // "seen" হিসেবে আপডেট করুন
//        if (!$notification->seen) {
//            $notification->seen = true;
//            $notification->save();
//        }
        $notification = Notification::findOrFail($id);

        // ব্যবহারকারীর `seen` স্ট্যাটাস আপডেট করুন
        auth()->user()->notifications()->updateExistingPivot($id, ['is_seen' => true]);


        return view('user.notifications.show', compact('notification'));
    }
}
