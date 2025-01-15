<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;


class TaskController extends Controller
{
    // সব টাস্ক দেখানোর মেথড
    public function index()
    {
        $tasks = Task::all(); // সব টাস্ক রিট্রিভ করবে
        return view('admin.tasks.index', compact('tasks'));
    }

// নতুন টাস্ক তৈরি করার ফর্ম দেখানোর মেথড
    public function create()
    {
        return view('admin.tasks.create');
    }

// নতুন টাস্ক এড করার মেথড
    public function store(Request $request)
    {
        // ভ্যালিডেশন
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'link' => 'required|url', // লিঙ্কের জন্য ভ্যালিডেশন
        ]);

        // নতুন টাস্ক তৈরি
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'link' => $request->link, // লিঙ্ক সংরক্ষণ
        ]);

        return redirect()->route('admin.tasks.index')->with('success', 'Task added successfully.');
    }

// টাস্ক ডিলিট করার মেথড
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully.');
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('admin.tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        // ভ্যালিডেশন
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        // টাস্ক আপডেট
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
        ]);

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully.');
    }

    public function showTask($id)
    {
        $task = Task::findOrFail($id);
        return view('admin.tasks.view', compact('task'));
    }


}
