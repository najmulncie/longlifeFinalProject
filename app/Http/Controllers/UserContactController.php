<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class UserContactController extends Controller
{
    public function index()
    {
        // User er contact list fetch kore view te pathano
        $contacts = Contact::all(); // User specific contacts fetch korte caile query customize korte paren

        return view('user.contacts.index', compact('contacts'));
    }
}

