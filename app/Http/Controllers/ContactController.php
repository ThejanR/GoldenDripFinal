<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Show the contact page
    public function index()
    {
        return view('contact');
    }

    // Handle form submission
    public function store(Request $request)
    {
        // 1. Validate the data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // 2. (Optional) Send Email Logic would go here
        // Mail::to('admin@goldendrip.com')->send(new ContactFormMail($validated));

        // 3. Return JSON response for the JavaScript
        return response()->json([
            'success' => true, 
            'message' => 'Thank you! Your message has been sent successfully.'
        ]);
    }
}