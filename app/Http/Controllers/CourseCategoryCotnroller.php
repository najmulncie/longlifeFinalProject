<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseCategory;

class CourseCategoryCotnroller extends Controller
{


    public function create()
    {
        $categories = CourseCategory::all();
        return view('admin.course.category.create', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' =>  'required|unique:course_categories,name',
        ]);

        CourseCategory::create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Category created successfully!');
    }

    public function destroy($id)
    {
        $courseCategory = CourseCategory::findOrFail($id);
        $courseCategory->delete();

        return back()->with('success', 'Category deleted successfully!');
    }


}
