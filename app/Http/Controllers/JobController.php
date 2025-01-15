<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('user.jobs.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|url',
            'limit' => 'required|integer|min:1',
            'min_amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ইমেজ ফাইল ভ্যালিডেশন
        ]);
    
        $data = $request->all();
    
        // ইমেজ ফাইল আপলোড
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/jobs'), $fileName);
            $data['image'] = 'uploads/jobs/' . $fileName; // ইমেজ পাথ সেভ করা
        }
    
        $job = Job::create($data);
        $job->calculateTotalCost(); // টোটাল খরচ আপডেট করা
    
        return redirect()->route('user.jobs.create')->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|url',
            'limit' => 'required|integer|min:1',
            'min_amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ইমেজ ফাইল ভ্যালিডেশন
        ]);
    
        $data = $request->all();
    
        // ইমেজ ফাইল আপডেট
        if ($request->hasFile('image')) {
            // পুরানো ইমেজ ডিলিট করা (যদি থাকে)
            if ($job->image && file_exists(public_path($job->image))) {
                unlink(public_path($job->image));
            }
    
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/jobs'), $fileName);
            $data['image'] = 'uploads/jobs/' . $fileName; // ইমেজ পাথ সেভ করা
        }
    
        $job->update($data);
        $job->calculateTotalCost(); // টোটাল খরচ আপডেট করা
    
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // Delete image file if it exists
        if ($job->image && file_exists(public_path($job->image))) {
            unlink(public_path($job->image));
        }

        $job->delete();
        return response()->json(['message' => 'Job deleted successfully']);
    
    }
}
