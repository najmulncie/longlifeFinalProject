<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SectionController extends Controller
{
    public function index()
    {
        // Fetch all sections from the database
        $sections = Section::all();

        // Pass the data to the view
        return view('admin.sections.index', compact('sections'));
    }
    // Show create form
    public function create()
    {
        return view('admin.sections.create');
    }

    // Store new section with validation
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'icon'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link'  => 'required|url',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload for icon
        if ($request->hasFile('icon')) {
            // Get the uploaded file
            $icon = $request->file('icon');

            // Define the path where you want to save the file
            $destinationPath = public_path('backend/images/icons');

            // Create the folder if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Generate a unique name for the file
            $iconName = time() . '_' . $icon->getClientOriginalName();

            // Move the file to the specified folder
            $icon->move($destinationPath, $iconName);

            // Save the file path for database storage
            $iconPath = 'backend/images/icons/' . $iconName;
        }


        // Create a new section
        Section::create([
            'title' => $request->title,
            'icon'  => $iconPath,
            'link'  => $request->link,
        ]);
        
        return redirect()->route('sections.index')->with('success', 'Section created successfully.');
    }

    // Edit form
    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return view('admin.sections.edit', compact('section'));
    }

    // Update section with validation
    public function update(Request $request, $id)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'icon'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // icon is optional during update
            'link'  => 'required|url',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $section = Section::findOrFail($id);

        // Handle file upload for icon if exists
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public');
            $section->icon = $iconPath;
        }

        // Update section details
        $section->title = $request->title;
        $section->link = $request->link;
        $section->save();
        $notification = array(
            'message' => 'Section created successfully.',
            'alert-type' =>'success',
        );
        return redirect()->route('sections.index')->with($notification);
    }

    // Delete section
    public function destroy($id)
    {
        $section = Section::findOrFail($id);

        // Delete the icon if exists
        if (file_exists(public_path($section->icon))) {
            unlink(public_path($section->icon));
        }

        // Delete the section
        $section->delete();

        $notification = array(
            'message' => 'Section deleted successfully.',
            'alert-type' =>'success',
        );

        return redirect()->route('sections.index')->with($notification);
    }



}
