<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class UserTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('user.task.index', compact('tasks'));
    }

    public function showTask($id)
    {
        $task = Task::findOrFail($id);
        return view('user.task.show', compact('task'));
    }


    public function submitTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $user = auth()->user();

        // ইউজারকে সক্রিয় করতে হবে কিনা চেক করুন
        if (!$user->is_active) {
            return redirect()->route('tasks.show', $id)->with('error', 'Your account is not active yet. Please activate your account to receive commissions.');
        }
        // ইউজার টাস্ক সম্পন্ন করেছে তা আপডেট করুন
        $user->tasks()->syncWithoutDetaching([$task->id => ['completed_at' => now()]]);

        // বর্তমান ইউজারের ব্যালেন্সে টাস্কের এমাউন্ট যোগ করুন
        $user->main_balance += $task->amount;
        $user->save();

        // ইনকাম টেবিলে নতুন রেকর্ড যোগ করুন
        Income::create([
            'user_id' => $user->id,
            'amount' => $task->amount,
            'type' => 'task',
            'source' => 'task_submission', // এখানে source ফিল্ডের মান দিন
        ]);

        // সাকসেস মেসেজ দেখান
        return redirect()->route('tasks.show', $id)->with('success', 'Task completed successfully! Amount added to your balance.');
    }




}
