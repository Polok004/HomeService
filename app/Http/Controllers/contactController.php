<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade

class contactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function sendContactMail(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'location' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save the contact information to the database using query builder
        DB::table('contacts')->insert([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'location' => $validatedData['location'],
            'message' => $validatedData['message'],
            'created_at' => now(), // Add the current timestamp
            'updated_at' => now(), // Add the current timestamp
        ]);

        // Optionally, you can flash a success message
        // and redirect the user back to the contact page
        return redirect()->back()->with('message', 'Your message has been sent successfully!');
    }

    public function allMessages()
{
    // Fetch all contact messages from the database using query builder
    $messages = DB::table('contacts')->paginate(10); 

    // Pass the messages to the view
    return view('messages', ['messages' => $messages]);
}
}
