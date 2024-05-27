<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class contactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function sendContactMail(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'location' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        
        DB::table('contacts')->insert([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'location' => $validatedData['location'],
            'message' => $validatedData['message'],
            'created_at' => now(), 
            'updated_at' => now(), 
        ]);


        return redirect()->back()->with('message', 'Your message has been sent successfully!');
    }

    public function allMessages()
{
    
    $messages = DB::table('contacts')->paginate(10); 
    return view('messages', ['messages' => $messages]);
}
}
