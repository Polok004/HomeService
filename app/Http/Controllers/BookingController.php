<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class BookingController extends Controller
{

    public function showServiceDetails($service_slug)
    {
        $service = DB::table('services')
        ->join('service_catagories', 'services.service_category_id', '=', 'service_catagories.id')
        ->select('services.*', 'service_catagories.name as category_name')
        ->where('services.slug', $service_slug)
        ->first();

        // Check if service exists
        if (!$service) {
            abort(404); // or return a custom error view
        }

        // Fetch a related service (assuming you have a similar structure)
        $r_service = DB::table('services')
            ->where('service_category_id', $service->service_category_id)
            ->where('slug', '!=', $service_slug)
            ->inRandomOrder()
            ->first();

        // Initialize total with the service price
        $total = $service->price;
        session(['service' => $service]);

        return view('serviceDetails', compact('service', 'r_service', 'total'));
    }

    public function saveBooking(Request $request)
    {
         // Validate the form data
         $request->validate([
            'location' => 'required',
            'cardNo' => 'required',
            'date' => 'required',
            'time' => 'required',
            // Add more validation rules as needed
        ]);

        // Get authenticated user ID and name
        $user_id = Auth::user()->id;
        $customer_name = Auth::user()->name;
        $customer_phone = Auth::user()->phone;

             // Get form input data
             $location = $request->input('location');
             $cardNo = $request->input('cardNo');
             $date = $request->input('date');
             $time = $request->input('time');
     
             // Get service data from the session
             $service = $request->session()->get('service');
     
             // Check if service data exists in session
             if (!$service) {
                 // Handle case where service data is not available
                 return redirect()->route('inactive');
             }
     
             if (!$service->status) {
                 // Handle case where service is not active (cannot be booked)
                 return redirect()->route('inactive')->with('failed', 'service is unavailable');
             }
        // Get the authenticated user
        $user = Auth::user();

        // Get the service from the session
        $service = session('service');

        // Create a Stripe payment intent
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $intent = PaymentIntent::create([
            'amount' => $service->price * 100, // Stripe requires amount in cents
            'currency' => 'usd',
            'description' => 'Booking for ' . $service->name,
            'payment_method_types' => ['card'],
            'source' => $request->input('stripeToken'),
            'receipt_email' => $user->email,
        ]);

        // Insert booking data into the database
        DB::table('operation')->insert([
            'user_id' => $user_id,
            'customer_name' => $customer_name,
            'customer_phone' => $customer_phone,
            'customer_location' => $location,
            'customer_cardNo' => $cardNo,
            'customer_date' => $date,
            'customer_time' => $time,
            'service_id' => $service->id,
            'service_name' => $service->name,
            'service_price' => $service->price,
            'service_category' => $service->category_name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with success message
        return redirect()->route('confirmation')->with('success', 'Booking saved successfully');
    }
}
