<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Show all contacts
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    // Show form to create contact
    public function create()
    {
        return view('admin.contacts.create');
    }

    // Store contact in database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => [
                'required',
                'regex:/^\+8801[3-9]\d{8}$/', // +88 এর পর ফোন নম্বরের ফরম্যাট
            ],
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact added successfully.');
    }

    public function destroy(Contact $contact)
    {
        // Contact delete
        $contact->delete();

        $notification = array(
            'message' => 'Contact deleted successfully.',
            'alert-type' => 'success',
        );
        // Success message with redirect
        return redirect()->route('contacts.index')->with($notification);
    }

}

