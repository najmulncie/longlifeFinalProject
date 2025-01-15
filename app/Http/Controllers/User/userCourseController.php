<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseSection;

class userCourseController extends Controller
{
    public function index()
    {
        // $sections = CourseSection::with('videos')->get(); // Assuming Section has a 'videos' relationship
        $sections = CourseSection::with('category')
        ->get()
        ->groupBy(function($section) {
            return $section->category ? $section->category->id : 'no-category'; // Group by category ID or 'no-category' if none
        });

        

        return view('user.course.index', compact('sections'));
    }

    public function showVideos($categoryId)
    {
        $user = auth()->user();

        if (!$user->is_active) {
            return back()->with('error', 'You must be an active user to view videos.');
        }

        // $section = CourseSection::findOrFail($sectionId);
        $sections = CourseSection::where('category_id', $categoryId)->get();
        
        if ($sections->isEmpty()) {
            return back()->with('error', 'No sections found for this category.');
        }
        // $section = CourseSection::with('category')->findOrFail($sectionId);
        return view('user.course.videos', compact('sections'));
    }


}

