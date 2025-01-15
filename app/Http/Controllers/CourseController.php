<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseSection;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
   // List all sections
   public function index()
   {
    //    $sections = CourseSection::all(); // Fetch all sections
       $sections = CourseSection::with('category')->get(); // Eager load 'category' relationship

       return view('admin.course.index', compact('sections'));
   }

   // Show create form
   public function create()
   {
        $categories = CourseCategory::all();
       return view('admin.course.create', compact('categories')); // Return create form
   }

   // Store new section
   public function store(Request $request)
   {
       $request->validate([
           'title' => 'required|string|max:255',
           'video_url' => 'required|url',
           'category_id' => 'required',
       ]);

       CourseSection::create([
           'title' => $request->title,
           'video_url' => $request->video_url,
           'category_id' => $request->category_id,
       ]);

       return redirect()->route('course.sections.index')->with('success', 'Section created successfully!');
   }

   // Show edit form
   public function edit($id)
   {
       $section = CourseSection::findOrFail($id);
       return view('course.course.edit', compact('section'));
   }

   // Update section
   public function update(Request $request, $id)
   {
       $request->validate([
           'title' => 'required|string|max:255',
           'video_url' => 'required|url',
       ]);

       $section = CourseSection::findOrFail($id);
       $section->update([
           'title' => $request->title,
           'video_url' => $request->video_url,
       ]);

       return redirect()->route('course.sections.index')->with('success', 'Section updated successfully!');
   }

   // Delete section
   public function destroy($id)
   {
       $section = CourseSection::findOrFail($id);
       $section->delete();

       return redirect()->route('course.sections.index')->with('success', 'Section deleted successfully!');
   }


}
